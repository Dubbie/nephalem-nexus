<?php

namespace Database\Seeders;

use App\Models\ItemStatCost;
use App\Models\Stat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class StatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = $this->readFile('app/ItemStatCost.txt');

        Stat::query()->delete();

        foreach ($data as $isc) {
            try {
                Stat::create([
                    'stat' => $this->getValue($isc['Stat']),
                    'desc_func' => $this->getValue($isc['descfunc']),
                    'desc_priority' => $this->getValue($isc['descpriority']),
                    'desc_value' => $this->getValue($isc['descval']),
                    'desc_str_pos' => $this->getValue($isc['descstrpos']),
                    'desc_str_neg' => $this->getValue($isc['descstrneg']),
                    'desc_str_2' => $this->getValue($isc['descstr2']),
                    'desc_group' => $this->getValue($isc['dgrp']),
                    'desc_group_value' => $this->getValue($isc['dgrpval']),
                    'desc_group_str_pos' => $this->getValue($isc['dgrpstrpos']),
                    'desc_group_str_neg' => $this->getValue($isc['dgrpstrneg']),
                    'desc_group_str_2' => $this->getValue($isc['dgrpstr2']),
                ]);
            } catch (\Exception $e) {
                Log::error($e->getMessage());
            }
        }
    }

    private function getValue($variable)
    {
        return $variable === '' ? null : $variable;
    }

    private function readFile(string $path): array
    {
        // Read the file line by line
        $properties = file(storage_path($path), FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

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
}
