<?php

namespace Database\Seeders;

class DruidSkillSeeder extends BaseSkillSeeder
{
    protected function getClassName(): string
    {
        return 'Druid';
    }

    protected function getClassAttributes(): array
    {
        return [
            'name' => $this->getClassName(),
            'strength'  => 15,
            'dexterity' => 20,
            'vitality'  => 25,
            'energy'    => 20,
        ];
    }

    protected function getSkills(): array
    {
        return [
            'Elemental Skills' => [
                // First Row
                [
                    'name' => 'Firestorm',
                    'row' => 0,
                    'col' => 0,
                    'required_level' => 1,
                    'max_level' => 20,
                ],
                [
                    'name' => 'Arctic Blast',
                    'row' => 0,
                    'col' => 2,
                    'required_level' => 1,
                    'max_level' => 20,
                ],
                // Second Row
                [
                    'name' => 'Molten Boulder',
                    'row' => 1,
                    'col' => 0,
                    'required_level' => 6,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Firestorm'
                    ]
                ],
                [
                    'name' => 'Cyclone Armor',
                    'row' => 1,
                    'col' => 2,
                    'required_level' => 6,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Arctic Blast'
                    ]
                ],
                // Third Row
                [
                    'name' => 'Fissure',
                    'row' => 2,
                    'col' => 0,
                    'required_level' => 12,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Molten Boulder'
                    ]
                ],
                [
                    'name' => 'Twister',
                    'row' => 2,
                    'col' => 1,
                    'required_level' => 12,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Cyclone Armor'
                    ]
                ],
                // Fourth Row
                [
                    'name' => 'Gust',
                    'row' => 3,
                    'col' => 2,
                    'required_level' => 18,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Cyclone Armor'
                    ]
                ],
                // Fifth Row
                [
                    'name' => 'Volcano',
                    'row' => 4,
                    'col' => 0,
                    'required_level' => 24,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Fissure'
                    ]
                ],
                [
                    'name' => 'Tornado',
                    'row' => 4,
                    'col' => 1,
                    'required_level' => 24,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Twister'
                    ]
                ],
                // Sixth Row
                [
                    'name' => 'Armageddon',
                    'row' => 5,
                    'col' => 0,
                    'required_level' => 30,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Volcano'
                    ]
                ],
                [
                    'name' => 'Hurricane',
                    'row' => 5,
                    'col' => 1,
                    'required_level' => 30,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Tornado'
                    ]
                ],
            ],
            'Shape Shifting Skills' => [
                // First Row
                [
                    'name' => 'Werewolf',
                    'row' => 0,
                    'col' => 0,
                    'required_level' => 1,
                    'max_level' => 20,
                ],
                [
                    'name' => 'Lycanthropy',
                    'row' => 0,
                    'col' => 1,
                    'required_level' => 1,
                    'max_level' => 20,
                ],
                [
                    'name' => 'Werebear',
                    'row' => 0,
                    'col' => 2,
                    'required_level' => 1,
                    'max_level' => 20,
                ],
                //  Second Row
                [
                    'name' => 'Feral Rage',
                    'row' => 1,
                    'col' => 0,
                    'required_level' => 6,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Werewolf'
                    ]
                ],
                [
                    'name' => 'Maul',
                    'row' => 1,
                    'col' => 2,
                    'required_level' => 6,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Werebear'
                    ]
                ],
                // Third Row
                [
                    'name' => 'Hunger',
                    'row' => 2,
                    'col' => 1,
                    'required_level' => 12,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Maul'
                    ]
                ],
                // Fourth Row
                [
                    'name' => 'Rabies',
                    'row' => 3,
                    'col' => 0,
                    'required_level' => 18,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Feral Rage'
                    ]
                ],
                [
                    'name' => 'Shockwave',
                    'row' => 3,
                    'col' => 2,
                    'required_level' => 18,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Maul'
                    ]
                ],
                // Fifth Row
                [
                    'name' => 'Fire Claws',
                    'row' => 4,
                    'col' => 1,
                    'required_level' => 24,
                    'max_level' => 20,
                ],
                // Sixth Row
                [
                    'name' => 'Fury',
                    'row' => 5,
                    'col' => 0,
                    'required_level' => 30,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Rabies'
                    ]
                ],
            ],
            'Summoning Skills' => [
                // First Row
                [
                    'name' => 'Raven',
                    'row' => 0,
                    'col' => 1,
                    'required_level' => 1,
                    'max_level' => 20,
                ],
                [
                    'name' => 'Poison Creeper',
                    'row' => 0,
                    'col' => 2,
                    'required_level' => 1,
                    'max_level' => 20,
                ],
                // Second Row
                [
                    'name' => 'Heart of Wolverine',
                    'row' => 1,
                    'col' => 0,
                    'required_level' => 6,
                    'max_level' => 20,
                ],
                // Third Row
                [
                    'name' => 'Summon Spirit Wolf',
                    'row' => 2,
                    'col' => 1,
                    'required_level' => 12,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Raven'
                    ]
                ],
                [
                    'name' => 'Carrion Vine',
                    'row' => 2,
                    'col' => 2,
                    'required_level' => 12,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Poison Creeper'
                    ]
                ],
                // Fourth Row
                [
                    'name' => 'Spirit of Barbs',
                    'row' => 3,
                    'col' => 0,
                    'required_level' => 18,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Heart of Wolverine'
                    ]
                ],
                // Fifth Row
                [
                    'name' => 'Summon Dire Wolf',
                    'row' => 4,
                    'col' => 1,
                    'required_level' => 24,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Summon Spirit Wolf'
                    ]
                ],
                [
                    'name' => 'Solar Creeper',
                    'row' => 4,
                    'col' => 2,
                    'required_level' => 24,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Carrion Vine'
                    ]
                ],
                // Sixth Row
                [
                    'name' => 'Oak Sage',
                    'row' => 5,
                    'col' => 0,
                    'required_level' => 30,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Spirit of Barbs'
                    ]
                ],
                [
                    'name' => 'Summon Grizzly',
                    'row' => 5,
                    'col' => 1,
                    'required_level' => 30,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Summon Dire Wolf'
                    ]
                ],
            ],
        ];
    }
}
