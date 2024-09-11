<?php

namespace Database\Seeders;

use App\Models\DiabloClass;
use App\Models\Skill;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

abstract class BaseSkillSeeder extends Seeder
{
    abstract protected function getClassName(): string;
    abstract protected function getClassAttributes(): array;
    abstract protected function getSkills(): array;

    public function run(): void
    {
        $classAttributes = $this->getClassAttributes();
        $skills = $this->getSkills();
        $className = $this->getClassName();

        $class = DiabloClass::create($classAttributes);

        foreach ($skills as $categoryName => $skillCollection) {
            echo 'Creating ' . $categoryName . ' category for ' . $className . '...';
            $skillCategory = $class->skillCategories()->create(['name' => $categoryName]);
            $skillsCreated = new Collection();
            echo 'done!' . PHP_EOL;

            foreach ($skillCollection as $skillData) {
                $skill = new Skill();
                $skill->name = $skillData['name'];
                $skill->row = $skillData['row'];
                $skill->col = $skillData['col'];
                $skill->required_level = $skillData['required_level'];
                $skill->max_level = $skillData['max_level'];
                $skill->skill_category_id = $skillCategory->id;

                echo 'Creating skill: ' . $skill->name . '...';
                $skill->save();

                if (isset($skillData['prerequisites'])) {
                    foreach ($skillData['prerequisites'] as $prerequisiteName) {
                        $prerequisite = $skillsCreated->where('name', $prerequisiteName)->first();
                        if (!$prerequisite) {
                            throw new Exception('Prerequisite not found: ' . $prerequisiteName);
                        }
                        $skill->prerequisites()->create([
                            'prerequisite_id' => $prerequisite->id,
                        ]);
                    }
                }
                echo 'done!' . PHP_EOL;

                $skillsCreated->add($skill);
            }
        }

        echo $className . ' skills seeded!';
    }
}
