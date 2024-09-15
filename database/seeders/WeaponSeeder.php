<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\Weapon;

class WeaponSeeder extends FromFileSeeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Weapon::query()->delete();
        $data = $this->readFile('app/Weapons.txt');
        $this->create($data);
    }

    private function create(array $data): void
    {
        foreach ($data as $row) {
            if ($row['name'] === 'Expansion' || $row['type'] === 'tpot' || $row['spawnable'] !== '1') {
                continue;
            }

            // Create the weapon-specific entry
            $weapon = Weapon::create([
                'min_damage' => $row['mindam'] === '' ? null : $row['mindam'],
                'max_damage' => $row['maxdam'] === '' ? null : $row['maxdam'],
                'min_two_handed_damage' => $row['2handmindam'] === '' ? null : $row['2handmindam'],
                'max_two_handed_damage' => $row['2handmaxdam'] === '' ? null : $row['2handmaxdam'],
                'min_missile_damage' => $row['minmisdam'] === '' ? null : $row['minmisdam'],
                'max_missile_damage' => $row['maxmisdam'] === '' ? null : $row['maxmisdam'],
                'speed' => $row['speed'] === '' ? null : $row['speed'],
                'has_splash' => $row['rangeadder'] !== '' ? true : false,
                'required_strength' => $row['reqstr'] === '' ? 0 : $row['reqstr'],
                'required_dexterity' => $row['reqdex'] === '' ? 0 : $row['reqdex'],
            ]);

            // Create the base item
            $item = new Item([
                'name' => $row['name'],
                'code' => $row['code'],
                'type' => $row['type'],
                'gfx' => $row['invfile'],
                'level_requirement' => $row['levelreq'],
                'width' => $row['invwidth'],
                'height' => $row['invheight'],
                'max_sockets' => $row['gemsockets'] === '' ? 0 : $row['gemsockets'],
            ]);

            $weapon->item()->save($item);
        }
    }
}
