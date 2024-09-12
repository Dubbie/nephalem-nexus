<?php

namespace Database\Seeders;

use App\Models\ItemProperty;
use App\Models\ItemPropertyStat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PropertiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Delete all item properties
        DB::table('item_property_stats')->delete();
        DB::table('item_properties')->delete();

        $data = $this->getPropertiesFromFile();
        $this->createProperties($data);
    }

    private function getPropertiesFromFile(): array
    {
        // Read the file line by line
        $properties = file(storage_path('app/Properties.txt'), FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        // Get headers
        $headers = explode("\t", $properties[0]);

        // Loop through the lines
        $data = [];
        for ($line = 1; $line < count($properties); $line++) {
            $split = explode("\t", $properties[$line]);

            $property = [];
            foreach ($split as $index => $value) {
                $header = $headers[$index];
                $property[$header] = $value;
            }

            $data[] = $property;
        }

        return $data;
    }

    private function createProperties(array $properties): void
    {
        foreach ($properties as $property) {
            // Create the property
            $item = ItemProperty::create([
                'code' => $property['code'],
                'done' => $property['*done'] === '' ? false : true,
                'desc' => $property['*desc'],
                'param' => $property['*param'],
                'min' => $property['*min'] === '' ? null : $property['*min'],
                'max' => $property['*max'] === '' ? null : $property['*max'],
                'notes' => $property['*notes'],
                'eol' => $property['*eol']  === '0' ? false : true,
            ]);

            // Create related stats
            for ($i = 1; $i <= 7; $i++) {
                if (!empty($property["stat$i"])) {
                    $item->stats()->create([
                        'set' => $property["set$i"] === '' ? null : $property["set$i"],
                        'val' => $property["val$i"] === '' ? null : $property["val$i"],
                        'func' => $property["func$i"] === '' ? null : $property["func$i"],
                        'stat' => $property["stat$i"] === '' ? null : $property["stat$i"],
                    ]);
                }
            }
        }
    }
}
