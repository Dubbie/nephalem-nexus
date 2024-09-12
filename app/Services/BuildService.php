<?php

namespace App\Services;

use App\Models\Build;
use App\Models\ContentSection;
use App\Models\DiabloClass;
use App\Models\SkillTree;
use App\Models\SkillTreeChanges;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BuildService extends ApiService
{
    public function getFiltered(array $data)
    {
        $query = Build::active();

        if (array_key_exists('name', $data)) {
            $query->where('name', 'like', '%' . $data['name'] . '%');
        }

        return $this->apiResponse($query->get(), "Builds found!");
    }

    public function updateBasics(Build $build, array $data)
    {
        $build->name = $data['name'];
        if ($data['diablo_class_id'] !== $build['diablo_class_id']) {
            $build->diablo_class_id = $data['diablo_class_id'];
            $this->resetSkillTrees($build);
        }

        $build->save();

        Log::info("Build #{$build->id} basics updated.");
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

        return $this->apiResponse(null, "Skill tree saved!");
    }

    public function updateIntroduction(Build $build, string $introduction)
    {
        $build->introduction = $introduction;
        $build->save();

        Log::info("Build #{$build->id} introduction saved.");
    }

    public function updateStatus(Build $build, bool $active)
    {
        $build->active = $active;
        $build->save();

        Log::info("Build #{$build->id} status changed to {$active}");
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

            DB::commit();

            return $this->apiResponse(null, "Build custom sections updated!", 200);
        } catch (Exception $e) {
            DB::rollBack();

            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());

            return $this->apiResponse(null, $e->getMessage(), 500);
        }
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
