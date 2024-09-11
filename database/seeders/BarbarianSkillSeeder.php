<?php

namespace Database\Seeders;

class BarbarianSkillSeeder extends BaseSkillSeeder
{
    protected function getClassName(): string
    {
        return 'Barbarian';
    }

    protected function getClassAttributes(): array
    {
        return [
            'name' => $this->getClassName(),
            'strength'  => 30,
            'dexterity' => 20,
            'vitality'  => 25,
            'energy'    => 10,
        ];
    }

    protected function getSkills(): array
    {
        return [
            'Warcries' => [
                // First Row
                [
                    'name' => 'Howl',
                    'row' => 0,
                    'col' => 0,
                    'required_level' => 1,
                    'max_level' => 20,
                ],
                [
                    'name' => 'Find Potion',
                    'row' => 0,
                    'col' => 2,
                    'required_level' => 1,
                    'max_level' => 20,
                ],
                // Second Row
                [
                    'name' => 'Shout',
                    'row' => 1,
                    'col' => 0,
                    'required_level' => 6,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Howl'
                    ]
                ],
                [
                    'name' => 'War Cry',
                    'row' => 1,
                    'col' => 1,
                    'required_level' => 6,
                    'max_level' => 20,
                ],
                // Third Row
                [
                    'name' => 'Find Item',
                    'row' => 2,
                    'col' => 2,
                    'required_level' => 12,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Find Potion'
                    ]
                ],
                // Fourth Row
                [
                    'name' => 'Taunt',
                    'row' => 3,
                    'col' => 1,
                    'required_level' => 18,
                    'max_level' => 20,
                    'prerequisites' => [
                        'War Cry'
                    ]
                ],
                // Fifth Row
                [
                    'name' => 'Battle Orders',
                    'row' => 4,
                    'col' => 0,
                    'required_level' => 24,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Shout'
                    ]
                ],
                [
                    'name' => 'Grim Ward',
                    'row' => 4,
                    'col' => 2,
                    'required_level' => 24,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Taunt'
                    ]
                ],
                // Sixth Row
                [
                    'name' => 'Battle Command',
                    'row' => 5,
                    'col' => 0,
                    'required_level' => 30,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Battle Orders'
                    ]
                ],
                [
                    'name' => 'Battle Cry',
                    'row' => 5,
                    'col' => 1,
                    'required_level' => 30,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Battle Orders',
                        'Taunt'
                    ]
                ],
            ],
            'Combat Masteries' => [
                // First Row
                [
                    'name' => 'General Mastery',
                    'row' => 0,
                    'col' => 0,
                    'required_level' => 1,
                    'max_level' => 20,
                ],
                [
                    'name' => 'Throwing Mastery',
                    'row' => 0,
                    'col' => 2,
                    'required_level' => 1,
                    'max_level' => 20,
                ],
                // Second Row
                [
                    'name' => 'Polearm and Spear Mastery',
                    'row' => 1,
                    'col' => 1,
                    'required_level' => 6,
                    'max_level' => 20,
                ],
                // Third Row
                [
                    'name' => 'Combat Reflexes',
                    'row' => 2,
                    'col' => 0,
                    'required_level' => 12,
                    'max_level' => 20,
                ],
                // Fourth Row
                [
                    'name' => 'Iron Skin',
                    'row' => 3,
                    'col' => 2,
                    'required_level' => 18,
                    'max_level' => 20,
                ],
                // Fifth Row
                [
                    'name' => 'Increased Speed',
                    'row' => 4,
                    'col' => 0,
                    'required_level' => 24,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Combat Reflexes'
                    ]
                ],
                // Sixth Row
                [
                    'name' => 'Deep Wounds',
                    'row' => 5,
                    'col' => 1,
                    'required_level' => 30,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Increased Speed',
                        'Iron Skin'
                    ]
                ],
                [
                    'name' => 'Natural Resistance',
                    'row' => 5,
                    'col' => 2,
                    'required_level' => 30,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Iron Skin'
                    ]
                ],
            ],
            'Combat Skills' => [
                // First Row
                [
                    'name' => 'Bash',
                    'row' => 0,
                    'col' => 0,
                    'required_level' => 1,
                    'max_level' => 20,
                ],
                [
                    'name' => 'Double Swing',
                    'row' => 0,
                    'col' => 1,
                    'required_level' => 1,
                    'max_level' => 20,
                ],
                // Second Row
                [
                    'name' => 'Stun',
                    'row' => 1,
                    'col' => 0,
                    'required_level' => 6,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Bash'
                    ]
                ],
                [
                    'name' => 'Frenzy',
                    'row' => 1,
                    'col' => 2,
                    'required_level' => 6,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Double Swing'
                    ]
                ],
                // Third Row
                [
                    'name' => 'Leap',
                    'row' => 2,
                    'col' => 0,
                    'required_level' => 12,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Stun'
                    ]
                ],
                [
                    'name' => 'Concentrate',
                    'row' => 2,
                    'col' => 1,
                    'required_level' => 12,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Double Swing'
                    ]
                ],
                [
                    'name' => 'Double Throw',
                    'row' => 2,
                    'col' => 2,
                    'required_level' => 12,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Frenzy'
                    ]
                ],
                // Fourth Row
                // Fifth Row
                [
                    'name' => 'Leap Attack',
                    'row' => 4,
                    'col' => 0,
                    'required_level' => 24,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Leap'
                    ]
                ],
                [
                    'name' => 'Berserk',
                    'row' => 4,
                    'col' => 1,
                    'required_level' => 24,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Concentrate'
                    ]
                ],
                // Sixth Row
                [
                    'name' => 'Whirlwind',
                    'row' => 5,
                    'col' => 1,
                    'required_level' => 30,
                    'max_level' => 20,
                    'prerequisites' => [
                        'Berserk'
                    ]
                ],
            ],
        ];
    }
}
