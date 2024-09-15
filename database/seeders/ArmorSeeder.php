<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\Armor;

class ArmorSeeder extends FromFileSeeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Armor::query()->delete();
        $data = $this->readFile('app/Armor.txt');
        $this->create($data);
    }

    private function create(array $data): void
    {
        foreach ($data as $row) {
            if ($row['name'] === 'Expansion' || $row['type'] === 'tpot' || $row['spawnable'] !== '1') {
                continue;
            }

            $armor = Armor::create([
                'min_ac' => $row['minac'] === '' ? null : $row['minac'],
                'max_ac' => $row['maxac'] === '' ? null : $row['maxac'],
                'block' => $row['block'] === '' ? null : $row['block'],
                'required_strength' => $row['reqstr'] === '' ? 0 : $row['reqstr'],
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

            $armor->item()->save($item);
        }
    }
}
