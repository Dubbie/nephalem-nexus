<?php

namespace Database\Seeders;

class PaladinSkillSeeder extends BaseSkillSeeder
{
    protected function getClassName(): string
    {
        return 'Paladin';
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
            'Defensive Auras' => [
                // First Row
                [
                    'name' => 'Prayer',
                    'row' => 0,
                    'col' => 0,
                    'required_level' => 1,
                    'max_level' => 20,
                ],
                [
                    'name' => 'Resist Fire',
                    'row' => 0,
                    'col' => 2,
                    'required_level' => 1,
                    'max_level' => 20,
                ],
                // Second Row
                [
                    'name' => 'Defiance',
                    'row' => 1,
                    'col' => 1,
                    'required_level' => 6,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Prayer'
                    ]
                ],
                [
                    'name' => 'Resist Cold',
                    'row' => 1,
                    'col' => 2,
                    'required_level' => 6,
                    'max_level' => 20,
                ],
                // Third Row
                [
                    'name' => 'Cleansing',
                    'row' => 2,
                    'col' => 0,
                    'required_level' => 12,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Prayer'
                    ]
                ],
                [
                    'name' => 'Resist Lightning',
                    'row' => 2,
                    'col' => 2,
                    'required_level' => 12,
                    'max_level' => 20,
                ],
                // Fourth Row
                [
                    'name' => 'Vigor',
                    'row' => 3,
                    'col' => 1,
                    'required_level' => 18,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Defiance'
                    ]
                ],
                // Fifth Row
                [
                    'name' => 'Meditation',
                    'row' => 4,
                    'col' => 0,
                    'required_level' => 24,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Cleansing'
                    ]
                ],
                // Sixth Row
                [
                    'name' => 'Redemption',
                    'row' => 5,
                    'col' => 1,
                    'required_level' => 30,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Vigor'
                    ]
                ],
                [
                    'name' => 'Salvation',
                    'row' => 5,
                    'col' => 2,
                    'required_level' => 30,
                    'max_level' => 20,
                ],
            ],
            'Offensive Auras' => [
                // First Row
                [
                    'name' => 'Might',
                    'row' => 0,
                    'col' => 0,
                    'required_level' => 1,
                    'max_level' => 20,
                ],
                // Second Row
                [
                    'name' => 'Holy Fire',
                    'row' => 1,
                    'col' => 1,
                    'required_level' => 6,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Might'
                    ]
                ],
                [
                    'name' => 'Thorns',
                    'row' => 1,
                    'col' => 2,
                    'required_level' => 6,
                    'max_level' => 20,
                ],
                // Third Row
                [
                    'name' => 'Blessed Aim',
                    'row' => 2,
                    'col' => 0,
                    'required_level' => 12,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Might'
                    ]
                ],
                // Fourth Row
                [
                    'name' => 'Concentration',
                    'row' => 3,
                    'col' => 0,
                    'required_level' => 18,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Blessed Aim'
                    ]
                ],
                [
                    'name' => 'Holy Freeze',
                    'row' => 3,
                    'col' => 1,
                    'required_level' => 18,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Holy Fire'
                    ]
                ],
                // Fifth Row
                [
                    'name' => 'Holy Shock',
                    'row' => 4,
                    'col' => 1,
                    'required_level' => 24,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Holy Freeze'
                    ]
                ],
                [
                    'name' => 'Sanctuary',
                    'row' => 4,
                    'col' => 2,
                    'required_level' => 24,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Thorns'
                    ]
                ],
                // Sixth Row
                [
                    'name' => 'Fanaticism',
                    'row' => 5,
                    'col' => 0,
                    'required_level' => 30,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Concentration'
                    ]
                ],
                [
                    'name' => 'Conviction',
                    'row' => 5,
                    'col' => 2,
                    'required_level' => 30,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Sanctuary'
                    ]
                ],
            ],
            'Combat Skills' => [
                // First Row
                [
                    'name' => 'Sacrifice',
                    'row' => 0,
                    'col' => 0,
                    'required_level' => 1,
                    'max_level' => 20,
                ],
                [
                    'name' => 'Holy Bolt',
                    'row' => 0,
                    'col' => 1,
                    'required_level' => 1,
                    'max_level' => 20,
                ],
                [
                    'name' => 'Smite',
                    'row' => 0,
                    'col' => 2,
                    'required_level' => 1,
                    'max_level' => 20,
                ],
                // Second Row
                [
                    'name' => 'Zeal',
                    'row' => 1,
                    'col' => 0,
                    'required_level' => 6,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Sacrifice'
                    ]
                ],
                // Third Row
                [
                    'name' => 'Holy Light',
                    'row' => 2,
                    'col' => 1,
                    'required_level' => 12,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Holy Bolt'
                    ]
                ],
                [
                    'name' => 'Charge',
                    'row' => 2,
                    'col' => 2,
                    'required_level' => 12,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Smite'
                    ]
                ],
                // Fourth Row
                [
                    'name' => 'Vengeance',
                    'row' => 3,
                    'col' => 0,
                    'required_level' => 18,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Zeal'
                    ]
                ],
                [
                    'name' => 'Blessed Hammer',
                    'row' => 3,
                    'col' => 1,
                    'required_level' => 18,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Holy Light'
                    ]
                ],
                [
                    'name' => 'Holy Sword',
                    'row' => 3,
                    'col' => 2,
                    'required_level' => 18,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Charge'
                    ]
                ],
                // Fifth Row
                [
                    'name' => 'Joust',
                    'row' => 4,
                    'col' => 0,
                    'required_level' => 24,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Vengeance'
                    ]
                ],
                [
                    'name' => 'Fist of the Heavens',
                    'row' => 4,
                    'col' => 1,
                    'required_level' => 24,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Blessed Hammer'
                    ]
                ],
                [
                    'name' => 'Holy Shield',
                    'row' => 4,
                    'col' => 2,
                    'required_level' => 24,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Holy Sword'
                    ]
                ],
                // Sixth Row
                [
                    'name' => 'Holy Nova',
                    'row' => 5,
                    'col' => 1,
                    'required_level' => 30,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Fist of the Heavens',
                        'Holy Shield'
                    ]
                ],

            ],
        ];
    }
}
