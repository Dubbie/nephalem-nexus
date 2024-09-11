<?php

namespace Database\Seeders;

class AssassinSkillSeeder extends BaseSkillSeeder
{
    protected function getClassName(): string
    {
        return 'Assassin';
    }

    protected function getClassAttributes(): array
    {
        return [
            'name' => $this->getClassName(),
            'strength' => 20,
            'dexterity' => 20,
            'vitality' => 20,
            'energy' => 25,
        ];
    }

    /**
     * Run the database seeds.
     */
    protected function getSkills(): array
    {
        return [
            'Martial Arts' => [
                // First row
                [
                    'name' => 'Tiger Strike',
                    'row' => 0,
                    'col' => 1,
                    'required_level' => 1,
                    'max_level' => 20,
                ],
                [
                    'name' => 'Dragon Talon',
                    'row' => 0,
                    'col' => 2,
                    'required_level' => 1,
                    'max_level' => 20,
                ],
                // Second Row
                [
                    'name' => 'Fists of Fire',
                    'row' => 1,
                    'col' => 0,
                    'required_level' => 6,
                    'max_level' => 20,
                ],
                [
                    'name' => 'Dragon Claw',
                    'row' => 1,
                    'col' => 2,
                    'required_level' => 6,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Dragon Talon'
                    ],
                ],
                // Third Row
                [
                    'name' => 'Cobra Strike',
                    'row' => 2,
                    'col' => 1,
                    'required_level' => 12,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Tiger Strike'
                    ],
                ],
                // Fourth Row
                [
                    'name' => 'Claws of Thunder',
                    'row' => 3,
                    'col' => 0,
                    'required_level' => 18,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Fists of Fire'
                    ]
                ],
                [
                    'name' => 'Dragon Tail',
                    'row' => 3,
                    'col' => 2,
                    'required_level' => 18,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Dragon Claw'
                    ]
                ],
                // Fifth Row
                [
                    'name' => 'Blades of Ice',
                    'row' => 4,
                    'col' => 0,
                    'required_level' => 24,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Claws of Thunder'
                    ]
                ],
                [
                    'name' => 'Dragon Flight',
                    'row' => 4,
                    'col' => 2,
                    'required_level' => 24,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Dragon Tail'
                    ]
                ],
                // Sixth Row
                [
                    'name' => 'Phoenix Strike',
                    'row' => 5,
                    'col' => 1,
                    'required_level' => 30,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Blades of Ice'
                    ]
                ],
            ],
            'Shadow Disciplines' => [
                // First Row
                [
                    'name' => 'Claw and Dagger Mastery',
                    'row' => 0,
                    'col' => 1,
                    'required_level' => 1,
                    'max_level' => 20,
                ],
                [
                    'name' => 'Psychic Hammer',
                    'row' => 0,
                    'col' => 2,
                    'required_level' => 1,
                    'max_level' => 20,
                ],
                // Second Row
                [
                    'name' => 'Burst of Speed',
                    'row' => 1,
                    'col' => 0,
                    'required_level' => 6,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Claw and Dagger Mastery'
                    ]
                ],
                // Third Row
                [
                    'name' => 'Weapon Block',
                    'row' => 2,
                    'col' => 1,
                    'required_level' => 12,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Claw and Dagger Mastery'
                    ]
                ],
                [
                    'name' => 'Cloak of Shadows',
                    'row' => 2,
                    'col' => 2,
                    'required_level' => 12,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Psychic Hammer'
                    ]
                ],
                // Fourth Row
                [
                    'name' => 'Fade',
                    'row' => 3,
                    'col' => 0,
                    'required_level' => 18,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Burst of Speed'
                    ]
                ],
                [
                    'name' => 'Shadow Warrior',
                    'row' => 3,
                    'col' => 1,
                    'required_level' => 18,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Cloak of Shadows',
                        'Weapon Block'
                    ]
                ],
                [
                    'name' => 'Mind Blast',
                    'row' => 3,
                    'col' => 2,
                    'required_level' => 18,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Cloak of Shadows'
                    ]
                ],
                // Fifth Row
                // Sixth Row
                [
                    'name' => 'Venom',
                    'row' => 5,
                    'col' => 0,
                    'required_level' => 30,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Fade'
                    ]
                ],
                [
                    'name' => 'Shadow Master',
                    'row' => 5,
                    'col' => 1,
                    'required_level' => 30,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Shadow Warrior'
                    ]
                ],
            ],
            'Traps' => [
                // First Row
                [
                    'name' => 'Fire Blast',
                    'row' => 0,
                    'col' => 1,
                    'required_level' => 1,
                    'max_level' => 20,
                ],
                // Second Row
                [
                    'name' => 'Shock Web',
                    'row' => 1,
                    'col' => 0,
                    'required_level' => 6,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Fire Blast'
                    ]
                ],
                [
                    'name' => 'Blade Sentinel',
                    'row' => 1,
                    'col' => 2,
                    'required_level' => 6,
                    'max_level' => 20,
                ],
                // Third Row
                [
                    'name' => 'Charged Bolt Sentry',
                    'row' => 2,
                    'col' => 0,
                    'required_level' => 12,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Shock Web'
                    ]
                ],
                [
                    'name' => 'Wake of Fire',
                    'row' => 2,
                    'col' => 1,
                    'required_level' => 12,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Fire Blast'
                    ]
                ],
                // Fourth Row
                [
                    'name' => 'Blade Fury',
                    'row' => 3,
                    'col' => 2,
                    'required_level' => 18,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Blade Sentinel'
                    ]
                ],
                // Fifth Row
                [
                    'name' => 'Lightning Sentry',
                    'row' => 4,
                    'col' => 0,
                    'required_level' => 24,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Charged Bolt Sentry'
                    ]
                ],
                [
                    'name' => 'Wake of Inferno',
                    'row' => 4,
                    'col' => 1,
                    'required_level' => 24,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Wake of Fire'
                    ]
                ],
                [
                    'name' => 'Blade Shield',
                    'row' => 4,
                    'col' => 2,
                    'required_level' => 24,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Blade Fury'
                    ]
                ],
                // Sixth Row
                [
                    'name' => 'Chain Lightning Sentry',
                    'row' => 5,
                    'col' => 0,
                    'required_level' => 30,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Lightning Sentry'
                    ]
                ],
                [
                    'name' => 'Death Sentry',
                    'row' => 5,
                    'col' => 1,
                    'required_level' => 30,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Wake of Inferno'
                    ]
                ],
            ]
        ];
    }
}
