<?php

namespace Database\Seeders;

class SorceressSkillSeeder extends BaseSkillSeeder
{
    protected function getClassName(): string
    {
        return 'Sorceress';
    }

    protected function getClassAttributes(): array
    {
        return [
            'name' => $this->getClassName(),
            'strength'  => 10,
            'dexterity' => 25,
            'vitality'  => 10,
            'energy'    => 35,
        ];
    }

    protected function getSkills(): array
    {
        return [
            'Cold Spells' => [
                // First Row
                [
                    'name' => 'Ice Bolt',
                    'row' => 0,
                    'col' => 1,
                    'required_level' => 1,
                    'max_level' => 20,
                ],
                [
                    'name' => 'Cold Enchant',
                    'row' => 0,
                    'col' => 2,
                    'required_level' => 1,
                    'max_level' => 20,
                ],
                // Second Row
                [
                    'name' => 'Frost Nova',
                    'row' => 1,
                    'col' => 0,
                    'required_level' => 6,
                    'max_level' => 20,
                ],
                [
                    'name' => 'Ice Blast',
                    'row' => 1,
                    'col' => 1,
                    'required_level' => 6,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Ice Bolt'
                    ]
                ],
                // Third Row
                [
                    'name' => 'Shiver Armor',
                    'row' => 2,
                    'col' => 2,
                    'required_level' => 12,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Cold Enchant'
                    ]
                ],
                // Fourth Row
                [
                    'name' => 'Glacial Spike',
                    'row' => 3,
                    'col' => 1,
                    'required_level' => 18,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Ice Blast'
                    ]
                ],
                // Fifth Row
                [
                    'name' => 'Blizzard',
                    'row' => 4,
                    'col' => 0,
                    'required_level' => 24,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Frost Nova',
                        'Glacial Spike'
                    ]
                ],
                [
                    'name' => 'Ice Barrage',
                    'row' => 4,
                    'col' => 1,
                    'required_level' => 24,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Glacial Spike'
                    ]
                ],
                [
                    'name' => 'Chilling Armor',
                    'row' => 4,
                    'col' => 2,
                    'required_level' => 24,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Shiver Armor'
                    ]
                ],
                // Sixth Row
                [
                    'name' => 'Frozen Orb',
                    'row' => 5,
                    'col' => 0,
                    'required_level' => 30,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Blizzard'
                    ]
                ],
                [
                    'name' => 'Cold Mastery',
                    'row' => 5,
                    'col' => 1,
                    'required_level' => 30,
                    'max_level' => 20,
                ],
            ],
            'Lightning Spells' => [
                // First Row
                [
                    'name' => 'Static Field',
                    'row' => 0,
                    'col' => 0,
                    'required_level' => 1,
                    'max_level' => 20,
                ],
                [
                    'name' => 'Charged Bolt',
                    'row' => 0,
                    'col' => 1,
                    'required_level' => 1,
                    'max_level' => 20,
                ],
                [
                    'name' => 'Telekinesis',
                    'row' => 0,
                    'col' => 2,
                    'required_level' => 1,
                    'max_level' => 20,
                ],
                // Second Row
                // Third Row
                [
                    'name' => 'Nova',
                    'row' => 2,
                    'col' => 0,
                    'required_level' => 12,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Charged Bolt'
                    ]
                ],
                [
                    'name' => 'Lightning',
                    'row' => 2,
                    'col' => 1,
                    'required_level' => 12,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Charged Bolt'
                    ]
                ],
                // Fourth Row
                [
                    'name' => 'Teleport',
                    'row' => 3,
                    'col' => 2,
                    'required_level' => 18,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Telekinesis'
                    ]
                ],
                // Fifth Row
                [
                    'name' => 'Thunder Storm',
                    'row' => 4,
                    'col' => 0,
                    'required_level' => 24,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Lightning',
                        'Nova'
                    ]
                ],
                [
                    'name' => 'Chain Lightning',
                    'row' => 4,
                    'col' => 1,
                    'required_level' => 24,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Lightning'
                    ]
                ],
                // Sixth Row
                [
                    'name' => 'Lightning Mastery',
                    'row' => 5,
                    'col' => 1,
                    'required_level' => 30,
                    'max_level' => 20,
                ],
                [
                    'name' => 'Energy Shield',
                    'row' => 5,
                    'col' => 2,
                    'required_level' => 30,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Teleport'
                    ]
                ],
            ],
            'Fire Spells' => [
                // First Row
                [
                    'name' => 'Inferno',
                    'row' => 0,
                    'col' => 0,
                    'required_level' => 1,
                    'max_level' => 20,
                ],
                [
                    'name' => 'Fire Bolt',
                    'row' => 0,
                    'col' => 1,
                    'required_level' => 1,
                    'max_level' => 20,
                ],
                [
                    'name' => 'Warmth',
                    'row' => 0,
                    'col' => 2,
                    'required_level' => 1,
                    'max_level' => 20,
                ],
                // Second Row
                [
                    'name' => 'Blaze',
                    'row' => 1,
                    'col' => 0,
                    'required_level' => 6,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Inferno'
                    ]
                ],
                // Third Row
                [
                    'name' => 'Fire Wall',
                    'row' => 2,
                    'col' => 0,
                    'required_level' => 12,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Inferno'
                    ]
                ],
                [
                    'name' => 'Fire Ball',
                    'row' => 2,
                    'col' => 1,
                    'required_level' => 12,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Fire Bolt'
                    ]
                ],
                [
                    'name' => 'Lesser Hydra',
                    'row' => 2,
                    'col' => 2,
                    'required_level' => 12,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Warmth'
                    ]
                ],
                // Fourth Row
                [
                    'name' => 'Enchant Fire',
                    'row' => 3,
                    'col' => 2,
                    'required_level' => 18,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Lesser Hydra',
                        'Fire Ball'
                    ]
                ],
                // Fifth Row
                [
                    'name' => 'Meteor',
                    'row' => 4,
                    'col' => 0,
                    'required_level' => 24,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Fire Wall',
                        'Fire Ball'
                    ]
                ],
                [
                    'name' => 'Combustion',
                    'row' => 4,
                    'col' => 1,
                    'required_level' => 24,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Fire Ball'
                    ]
                ],
                // Sixth Row
                [
                    'name' => 'Fire Mastery',
                    'row' => 5,
                    'col' => 1,
                    'required_level' => 30,
                    'max_level' => 20,
                ],
                [
                    'name' => 'Hydra',
                    'row' => 5,
                    'col' => 2,
                    'required_level' => 30,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Enchant Fire'
                    ]
                ],
            ],
        ];
    }
}
