<?php

namespace Database\Seeders;

use App\Models\Property;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PropertySeeder extends FromFileSeeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Delete all item properties
        Property::query()->delete();

        $data = $this->readFile('app/Properties.txt');
        $this->createProperties($data);
    }

    private function createProperties(array $properties): void
    {
        foreach ($properties as $property) {
            DB::beginTransaction();

            try {
                // Create the property
                $item = Property::create([
                    'code' => $property['code'],
                    'done' => $property['*done'] === '' ? false : true,
                    'desc' => $property['*desc'],
                    'param' => $property['*param'],
                    'min' => $property['*min'] === '' ? null : $property['*min'],
                    'max' => $property['*max'] === '' ? null : $property['*max'],
                ]);

                // Create related stats
                for ($i = 1; $i <= 7; $i++) {
                    if (!empty($property["stat$i"])) {
                        $item->propertyStats()->create([
                            'set' => $property["set$i"] === '' ? null : $property["set$i"],
                            'value' => $property["val$i"] === '' ? null : $property["val$i"],
                            'function' => $property["func$i"] === '' ? null : $property["func$i"],
                            'stat' => $property["stat$i"] === '' ? null : $property["stat$i"],
                            'stat_number' => $i,
                        ]);
                    }
                }

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error($e->getMessage());
            }
        }
    }
}
