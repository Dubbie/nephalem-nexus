<?php

namespace Database\Seeders;

use App\Models\Affix;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AffixSeeder extends FromFileSeeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Delete all existing affixes
        Affix::query()->delete();

        $prefixData = $this->readFile('app/MagicPrefix.txt');
        // Add 'type' => 'prefix' to all entries inside prefixData
        $prefixData = array_map(function ($entry) {
            return array_merge($entry, ['type' => 'prefix']);
        }, $prefixData);
        $suffixData = $this->readFile('app/MagicSuffix.txt');
        // Add 'type' => 'suffix' to all entries inside suffixData
        $suffixData = array_map(function ($entry) {
            return array_merge($entry, ['type' => 'suffix']);
        }, $suffixData);
        $data = array_merge($prefixData, $suffixData);

        $this->createAffixes($data);
    }

    private function createAffixes(array $data): void
    {
        foreach ($data as $entry) {
            if ($entry['Name'] === '' || $entry['Name'] === 'Expansion') {
                continue;
            }

            try {
                DB::beginTransaction();

                // Create base affix
                $affix = Affix::create([
                    'type' => $entry['type'],
                    'name' => $entry['Name'],
                    'required_level' => $entry['levelreq'],
                    'class' => $entry['classspecific'] === '' ? null : $entry['classspecific'],
                    'group' => $entry['group'] === '' ? null : intval($entry['group']),
                ]);

                // Create the mods if needed
                for ($modCount = 1; $modCount <= 3; $modCount++) {
                    if ($entry["mod{$modCount}code"] !== '') {
                        $affix->mods()->create([
                            'code' => $entry["mod{$modCount}code"],
                            'min' => $entry["mod{$modCount}min"],
                            'max' => $entry["mod{$modCount}max"],
                            'param' => $entry["mod{$modCount}param"] === '' ? null : $entry["mod{$modCount}param"],
                            'mod_number' => $modCount,
                        ]);
                    }
                }

                // Create item type specifics
                for ($i = 1; $i <= 7; $i++) {
                    if ($entry["itype{$i}"] !== '') {
                        $affix->itemTypes()->create([
                            'item_type' => $entry["itype{$i}"],
                        ]);
                    }
                }

                // Exlcuded item types
                for ($i = 1; $i <= 5; $i++) {
                    if ($entry["itype{$i}"] !== '') {
                        $affix->excludedItemTypes()->create([
                            'item_type' => $entry["etype{$i}"],
                        ]);
                    }
                }

                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
                Log::error($e->getMessage());
            }
        }
    }
}
