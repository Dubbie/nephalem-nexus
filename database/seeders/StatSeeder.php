<?php

namespace Database\Seeders;

use App\Models\Stat;
use App\Models\TblEntry;
use Illuminate\Support\Facades\Log;

class StatSeeder extends FromFileSeeder
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
                $this->createStat($isc);
            } catch (\Exception $e) {
                $strings = ['descstrpos', 'descstrneg', 'descstr2', 'dgrpstrpos', 'dgrpstrneg', 'dgrpstr2'];

                foreach ($strings as $stringKey) {
                    $string = $this->getValue($isc[$stringKey]);

                    if ($string) {
                        $found = TblEntry::where('key', $string)->first();

                        if (!$found) {
                            echo "String not found: " . $string . PHP_EOL;
                            TblEntry::create([
                                'key' => $string,
                                'value' => 'TODO: ' . $string,
                            ]);
                        }
                    }
                }

                $this->createStat($isc);
            }
        }
    }

    private function createStat($isc): void
    {
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
    }

    private function getValue($variable)
    {
        return $variable === '' ? null : $variable;
    }
}
