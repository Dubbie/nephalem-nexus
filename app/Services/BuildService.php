<?php

namespace App\Services;

use App\Models\Build;
use App\Models\BuildView;
use App\Models\ContentSection;
use App\Models\DiabloClass;
use App\Models\SkillTree;
use App\Models\SkillTreeChanges;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BuildService extends ApiService
{
    public function getFiltered(array $data)
    {
        try {
            $query = Build::active();

            if (array_key_exists('search', $data)) {
                $query->where('name', 'like', '%' . $data['search'] . '%');
            }

            if (array_key_exists('class_id', $data)) {
                $query->where('diablo_class_id', $data['class_id']);
            }

            return $this->apiResponse($query->get(), "Builds found!");
        } catch (Exception $e) {
            return $this->apiResponse(null, 'Error while fetching guides', 500, false);
        }
    }

    public function updateBasics(Build $build, array $data)
    {
        try {
            $build->name = $data['name'];
            if ($data['diablo_class_id'] !== $build['diablo_class_id']) {
                $build->diablo_class_id = $data['diablo_class_id'];
                $this->resetSkillTrees($build);
            }

            $build->save();

            Log::info("Build #{$build->id} basics updated.");

            return $this->apiResponse($build, "Build basics updated!");
        } catch (Exception $e) {
            return $this->apiResponse(null, $e->getMessage(), 500, false);
        }
    }

    public function delete(Build $build)
    {
        try {
            $build->delete();
            Log::info("Build #{$build->id} deleted.");

            return $this->apiResponse($build, "Build deleted!");
        } catch (Exception $e) {
            return $this->apiResponse(null, $e->getMessage(), 500, false);
        }
    }

    public function updateSkillTree(Build $build, array $data)
    {
        // Get the skills which have a level higher than 0
        $skills = $this->transformBaseTree($data);

        // Save the base skills
        $skillTree = SkillTree::where('build_id', $build->id)->first();
        if ($skillTree === null) {
            // Create new
            $skillTree = $build->skillTrees()->create([
                'base_skills' => $skills,
                'description' => $data['description'] ?? null,
            ]);
        } else {
            // Update existing
            $skillTree->base_skills = $skills;
            $skillTree->description = $data['description'] ?? null;
            $skillTree->save();
        }

        // Save the stack data
        // But first, delete the old data
        SkillTreeChanges::where('skill_tree_id', $skillTree->id)->delete();
        if (array_key_exists('stack', $data) && count($data['stack']) > 0) {
            foreach ($data['stack'] as $skill) {
                $skillTree->skillChanges()->create([
                    'skill_id' => $skill['id'],
                    'level' => $skill['level'],
                ]);
            }
        }

        Log::info("Build {$build->id} skill tree updated");

        // Update the build updated_at timestamp
        $build->updated_at = Carbon::now();
        $build->save();

        return $this->apiResponse(null, "Skill tree saved!");
    }

    public function updateIntroduction(Build $build, string $introduction)
    {
        try {
            $build->introduction = $introduction;
            $build->save();

            Log::info("Build #{$build->id} introduction saved.");

            return $this->apiResponse($build, "Introduction saved!");
        } catch (Exception $e) {
            return $this->apiResponse(null, $e->getMessage(), 500, false);
        }
    }

    public function updateStatus(Build $build, bool $active)
    {
        try {
            $build->active = $active;
            $build->save();

            Log::info("Build #{$build->id} status changed to {$active}");
            $msg = $active ? "Guide published!" : "Guide hidden!";

            return $this->apiResponse($build, $msg);
        } catch (Exception $e) {
            return $this->apiResponse(null, $e->getMessage(), 500, false);
        }
    }

    public function updateDetails(Build $build, array $sections)
    {
        DB::beginTransaction();

        try {
            // Get all existing section IDs for this build from the database
            $existingSectionIds = $build->sections()->pluck('id')->toArray();

            // Prepare an array to track the IDs that should remain (those sent from the frontend)
            $receivedSectionIds = [];

            // Iterate through the sections sent from the frontend
            foreach ($sections as $order => $section) {
                // Check if the section is new or existing
                if (!$section['is_new']) {
                    // Store the existing section ID to keep it
                    $receivedSectionIds[] = $section['id'];

                    // Find the existing section and update it
                    $existingSection = $build->sections()->find($section['id']);

                    if ($existingSection) {
                        $existingSection->update([
                            'title' => $section['title'],
                            'order' => $order, // Update the order using the loop key
                        ]);

                        // Update the polymorphic content
                        $sectionable = $existingSection->sectionable;
                        $sectionable->update([
                            'content' => $section['content'],
                        ]);
                    }
                } else {
                    // Log info about new section creation
                    Log::info("Creating new section.");

                    // Determine the section type and create the polymorphic model
                    $sectionableType = $this->getSectionableType($section['type']);
                    $sectionableModel = $sectionableType::create([
                        'content' => $section['content'],
                    ]);

                    // Create the new section
                    $newSection = $build->sections()->create([
                        'title' => $section['title'],
                        'order' => $order, // Set the order using the loop key
                        'sectionable_type' => $sectionableType,
                        'sectionable_id' => $sectionableModel->id,
                    ]);

                    // Store the new section's ID to keep it
                    $receivedSectionIds[] = $newSection->id;
                }
            }

            // Find sections that exist in the database but were not sent by the frontend
            $sectionsToDelete = array_diff($existingSectionIds, $receivedSectionIds);

            // Delete sections that are not in the received data
            if (!empty($sectionsToDelete)) {
                $build->sections()->whereIn('id', $sectionsToDelete)->delete();
            }

            // Update the build updated_at timestamp
            $build->updated_at = Carbon::now();
            $build->save();

            DB::commit();

            return $this->apiResponse(null, "Build sections updated!", 200);
        } catch (Exception $e) {
            DB::rollBack();

            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());

            return $this->apiResponse(null, $e->getMessage(), 500);
        }
    }

    public function handleVisit(Build $build, string $ipAddress)
    {
        // Check if the visitor has already viewed the build (by IP or cookie)
        if (!$build->views()->where('ip_address', $ipAddress)->exists()) {
            // Record the unique view
            $build->views()->create(['ip_address' => $ipAddress]);
            Log::info("Build #{$build->id} visited by {$ipAddress}");
        }
    }

    public function like(Build $build)
    {
        try {
            if ($build->likes()->where('user_id', Auth::id())->exists()) {
                $build->likes()->where('user_id', Auth::id())->delete();
                return $this->apiResponse($build, "You no longer like this guide.");
            }

            $build->likes()->create(['user_id' => Auth::id()]);
            return $this->apiResponse($build, "Guide liked!");
        } catch (Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());

            return $this->apiResponse(null, "Something went wrong", 500, false);
        }
    }

    public function getTrending(int $count = 4)
    {
        return Build::withCount('likes')->active()->orderBy('likes_count', 'desc')->take($count)->get();
    }

    public function getPopular(int $count = 4)
    {
        return Build::withCount('views')->active()->orderBy('views_count', 'desc')->take($count)->get();
    }

    public function getRecent(int $count = 4)
    {
        return Build::active()->orderBy('created_at', 'desc')->take($count)->get();
    }

    private function transformBaseTree(array &$data)
    {
        $skills = [];

        foreach ($data['base_tree']['skill_categories'] as $skillCategory) {
            foreach ($skillCategory['skills'] as $skill) {
                $skillData = [
                    'id' => $skill['id'],
                ];

                if (! array_key_exists('level', $skill) || $skill['level'] === 0) {
                    $skillData['level'] = 0;
                } else {
                    $skillData['level'] = $skill['level'];
                }

                $skills[] = $skillData;
            }
        }

        return $skills;
    }

    private function getSectionableType($type)
    {
        // Map type to model class name
        $types = [
            'App\\Models\\ContentSection' => ContentSection::class,
        ];

        return $types[$type] ?? null;
    }

    private function resetSkillTrees(Build $build)
    {
        $build->skillTrees()->delete();
        Log::info("Build #{$build->id} skill trees reset.");
    }
}
