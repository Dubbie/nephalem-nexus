<?php

namespace Database\Seeders;

class NecromancerSkillSeeder extends BaseSkillSeeder
{
    protected function getClassName(): string
    {
        return 'Necromancer';
    }

    protected function getClassAttributes(): array
    {
        return [
            'name' => $this->getClassName(),
            'strength'  => 15,
            'dexterity' => 25,
            'vitality'  => 15,
            'energy'    => 25,
        ];
    }

    protected function getSkills(): array
    {
        return [
            'Summoning Spells' => [
                // First Row
                [
                    'name' => 'Raise Skeleton Warrior',
                    'row' => 0,
                    'col' => 2,
                    'required_level' => 1,
                    'max_level' => 20,
                ],
                [
                    'name' => 'Skeleton Mastery',
                    'row' => 0,
                    'col' => 0,
                    'required_level' => 1,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Raise Skeleton Warrior'
                    ]
                ],
                // Second Row
                [
                    'name' => 'Clay Golem',
                    'row' => 1,
                    'col' => 1,
                    'required_level' => 6,
                    'max_level' => 20,
                ],
                // Third Row
                [
                    'name' => 'Golem Mastery',
                    'row' => 2,
                    'col' => 0,
                    'required_level' => 12,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Clay Golem'
                    ]
                ],
                [
                    'name' => 'Raise Skeletal Mage',
                    'row' => 2,
                    'col' => 2,
                    'required_level' => 12,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Raise Skeleton Warrior'
                    ]
                ],
                // Fourth Row
                [
                    'name' => 'Blood Golem',
                    'row' => 3,
                    'col' => 1,
                    'required_level' => 18,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Clay Golem'
                    ]
                ],
                // Fifth Row
                [
                    'name' => 'Blood Warp',
                    'row' => 4,
                    'col' => 0,
                    'required_level' => 24,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Blood Golem'
                    ]
                ],
                [
                    'name' => 'Iron Golem',
                    'row' => 4,
                    'col' => 1,
                    'required_level' => 24,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Blood Golem'
                    ]
                ],
                [
                    'name' => 'Raise Skeleton Archer',
                    'row' => 4,
                    'col' => 2,
                    'required_level' => 24,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Raise Skeletal Mage'
                    ]
                ],
                // Sixth Row
                [
                    'name' => 'Fire Golem',
                    'row' => 5,
                    'col' => 1,
                    'required_level' => 30,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Iron Golem'
                    ]
                ],
                [
                    'name' => 'Revive',
                    'row' => 5,
                    'col' => 2,
                    'required_level' => 30,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Raise Skeleton Archer'
                    ]
                ]
            ],
            'Poison and Bone Spells' => [
                // First Row
                [
                    'name' => 'Poison Strike',
                    'row' => 0,
                    'col' => 0,
                    'required_level' => 1,
                    'max_level' => 20,
                ],
                [
                    'name' => 'Teeth',
                    'row' => 0,
                    'col' => 1,
                    'required_level' => 1,
                    'max_level' => 20,
                ],
                // Second Row
                [
                    'name' => 'Corpse Explosion',
                    'row' => 1,
                    'col' => 0,
                    'required_level' => 6,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Poison Strike'
                    ]
                ],
                [
                    'name' => 'Bone Armor',
                    'row' => 1,
                    'col' => 2,
                    'required_level' => 6,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Teeth'
                    ]
                ],
                // Third Row
                [
                    'name' => 'Desecrate',
                    'row' => 2,
                    'col' => 0,
                    'required_level' => 12,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Corpse Explosion'
                    ]
                ],
                [
                    'name' => 'Bone Wall',
                    'row' => 2,
                    'col' => 2,
                    'required_level' => 12,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Bone Armor'
                    ]
                ],
                // Fourth Row
                [
                    'name' => 'Bone Spear',
                    'row' => 3,
                    'col' => 1,
                    'required_level' => 18,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Teeth'
                    ]
                ],
                // Fifth Row
                [
                    'name' => 'Bone Prison',
                    'row' => 4,
                    'col' => 2,
                    'required_level' => 24,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Bone Wall'
                    ]
                ],
                // Sixth Row
                [
                    'name' => 'Poison Nova',
                    'row' => 5,
                    'col' => 0,
                    'required_level' => 30,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Desecrate'
                    ]
                ],
                [
                    'name' => 'Bone Spirit',
                    'row' => 5,
                    'col' => 1,
                    'required_level' => 30,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Bone Spear'
                    ]
                ],
            ],
            'Curses' => [
                // First Row
                [
                    'name' => 'Amplify Damage',
                    'row' => 0,
                    'col' => 1,
                    'required_level' => 1,
                    'max_level' => 20,
                ],
                [
                    'name' => 'Curse Mastery',
                    'row' => 0,
                    'col' => 2,
                    'required_level' => 1,
                    'max_level' => 20,
                ],
                // Second Row
                [
                    'name' => 'Dark Pact',
                    'row' => 1,
                    'col' => 0,
                    'required_level' => 6,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Amplify Damage'
                    ]
                ],
                [
                    'name' => 'Dim Vision',
                    'row' => 1,
                    'col' => 2,
                    'required_level' => 6,
                    'max_level' => 20,
                ],
                // Third Row
                [
                    'name' => 'Iron Maiden',
                    'row' => 2,
                    'col' => 0,
                    'required_level' => 12,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Dark Pact'
                    ]
                ],
                [
                    'name' => 'Life Tap',
                    'row' => 2,
                    'col' => 1,
                    'required_level' => 12,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Amplify Damage'
                    ]
                ],
                [
                    'name' => 'Terror',
                    'row' => 2,
                    'col' => 2,
                    'required_level' => 12,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Dim Vision'
                    ]
                ],
                // Fourth Row
                [
                    'name' => 'Weaken',
                    'row' => 3,
                    'col' => 1,
                    'required_level' => 18,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Life Tap'
                    ]
                ],
                [
                    'name' => 'Confuse',
                    'row' => 3,
                    'col' => 2,
                    'required_level' => 18,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Terror'
                    ]
                ],
                // Fifth Row
                [
                    'name' => 'Decrepify',
                    'row' => 4,
                    'col' => 0,
                    'required_level' => 24,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Weaken'
                    ]
                ],
                [
                    'name' => 'Attract',
                    'row' => 4,
                    'col' => 2,
                    'required_level' => 24,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Confuse'
                    ]
                ],
                // Sixth Row
                [
                    'name' => 'Lower Resist',
                    'row' => 5,
                    'col' => 1,
                    'required_level' => 30,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Weaken'
                    ]
                ],
            ],
        ];
    }
}
