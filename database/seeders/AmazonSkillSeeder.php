<?php

namespace Database\Seeders;

class AmazonSkillSeeder extends BaseSkillSeeder
{
    protected function getClassName(): string
    {
        return 'Amazon';
    }

    protected function getClassAttributes(): array
    {
        return [
            'name' => $this->getClassName(),
            'strength' => 20,
            'dexterity' => 25,
            'vitality' => 20,
            'energy' => 15,
        ];
    }

    /**
     * Run the database seeds.
     */
    protected function getSkills(): array
    {
        return [
            'Javelin and Spear Skills' => [
                // First row
                [
                    'name' => 'Jab',
                    'row' => 0,
                    'col' => 0,
                    'required_level' => 1,
                    'max_level' => 20,
                ],
                [
                    'name' => 'Poison Javelin',
                    'row' => 0,
                    'col' => 2,
                    'required_level' => 1,
                    'max_level' => 20,
                ],
                // Second row, level 6
                [
                    'name' => 'Javelin and Spear Mastery',
                    'row' => 1,
                    'col' => 0,
                    'required_level' => 6,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Jab'
                    ],
                ],
                [
                    'name' => 'Power Strike',
                    'row' => 1,
                    'col' => 1,
                    'required_level' => 6,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Jab'
                    ],
                ],
                // Third row
                [
                    'name' => 'Lightning Bolt',
                    'row' => 2,
                    'col' => 2,
                    'required_level' => 12,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Poison Javelin',
                        'Power Strike',
                    ],
                ],
                // Fourth Row
                [
                    'name' => 'Fend',
                    'row' => 3,
                    'col' => 0,
                    'required_level' => 18,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Javelin and Spear Mastery',
                    ],
                ],
                [
                    'name' => 'Charged Strike',
                    'row' => 3,
                    'col' => 1,
                    'required_level' => 18,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Power Strike',
                    ],
                ],
                [
                    'name' => 'Plague Javelin',
                    'row' => 3,
                    'col' => 2,
                    'required_level' => 18,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Lightning Bolt',
                    ],
                ],
                // Fifth Row
                // Sixth Row
                [
                    'name' => 'Lightning Strike',
                    'row' => 5,
                    'col' => 1,
                    'required_level' => 30,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Charged Strike',
                    ],
                ],
                [
                    'name' => 'Lightning Fury',
                    'row' => 5,
                    'col' => 2,
                    'required_level' => 30,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Plague Javelin',
                    ],
                ]
            ],
            'Passive and Magic Skills' => [
                // First row
                [
                    'name' => 'Inner Sight',
                    'row' => 0,
                    'col' => 0,
                    'required_level' => 1,
                    'max_level' => 20,
                ],
                [
                    'name' => 'Critical Strike',
                    'row' => 0,
                    'col' => 2,
                    'required_level' => 1,
                    'max_level' => 20,
                ],
                // Second row
                [
                    'name' => 'Evade',
                    'row' => 1,
                    'col' => 1,
                    'required_level' => 6,
                    'max_level' => 20,
                ],
                // Third row
                [
                    'name' => 'Slow Movement',
                    'row' => 2,
                    'col' => 0,
                    'required_level' => 12,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Inner Sight',
                    ],
                ],
                [
                    'name' => 'Pierce',
                    'row' => 2,
                    'col' => 2,
                    'required_level' => 12,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Critical Strike',
                    ],
                ],
                // Fourth row
                [
                    'name' => 'Decoy',
                    'row' => 3,
                    'col' => 0,
                    'required_level' => 18,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Slow Movement',
                    ],
                ],
                [
                    'name' => 'Dodge',
                    'row' => 3,
                    'col' => 1,
                    'required_level' => 18,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Slow Movement',
                    ],
                ],
                // Fifth row
                [
                    'name' => 'Penetrate',
                    'row' => 4,
                    'col' => 2,
                    'required_level' => 24,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Pierce',
                    ],
                ],
                // Sixth row
                [
                    'name' => 'Valkyrie',
                    'row' => 5,
                    'col' => 0,
                    'required_level' => 30,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Decoy',
                    ]
                ]
            ],
            'Bow and Crossbow Skills' => [
                // First row
                [
                    'name' => 'Magic Arrow',
                    'row' => 0,
                    'col' => 1,
                    'required_level' => 1,
                    'max_level' => 20,
                ],
                // Second row
                [
                    'name' => 'Cold Arrow',
                    'row' => 1,
                    'col' => 0,
                    'required_level' => 6,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Magic Arrow',
                    ]
                ],
                [
                    'name' => 'Multiple Shot',
                    'row' => 1,
                    'col' => 1,
                    'required_level' => 6,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Magic Arrow',
                    ]
                ],
                [
                    'name' => 'Fire Arrow',
                    'row' => 1,
                    'col' => 2,
                    'required_level' => 6,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Magic Arrow',
                    ]
                ],
                // Third row
                [
                    'name' => 'Ice Arrow',
                    'row' => 2,
                    'col' => 0,
                    'required_level' => 12,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Cold Arrow',
                    ]
                ],
                // Fourth row
                [
                    'name' => 'Guided Arrow',
                    'row' => 3,
                    'col' => 1,
                    'required_level' => 18,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Multiple Shot',
                    ]
                ],
                [
                    'name' => 'Exploding Arrow',
                    'row' => 3,
                    'col' => 2,
                    'required_level' => 18,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Fire Arrow',
                    ]
                ],
                // Fifth row
                [
                    'name' => 'Strafe',
                    'row' => 4,
                    'col' => 1,
                    'required_level' => 24,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Guided Arrow',
                    ]
                ],
                // Sixth row
                [
                    'name' => 'Freezing Arrow',
                    'row' => 5,
                    'col' => 0,
                    'required_level' => 30,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Ice Arrow',
                    ]
                ],
                // Sixth row
                [
                    'name' => 'Immolation Arrow',
                    'row' => 5,
                    'col' => 2,
                    'required_level' => 30,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Exploding Arrow',
                    ]
                ]
            ]
        ];
    }
}
