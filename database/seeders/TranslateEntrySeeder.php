<?php

namespace Database\Seeders;

use App\Models\TranslateEntry;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TranslateEntrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Delete all entries
        TranslateEntry::truncate();

        // Get entries
        $entries = $this->getEntries();

        // Create entries
        $this->createEntries($entries);
    }

    private function getEntries(): array
    {
        $base = $this->getEntriesFromFile('app/translations.csv');
        $patch = $this->getEntriesFromFile('app/translations_patch.csv');
        $exp = $this->getEntriesFromFile('app/translations_exp.csv');

        return array_merge($base, $patch, $exp);
    }

    private function getEntriesFromFile(string $path): array
    {
        // Read the file line by line
        $properties = file(storage_path($path), FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        // Loop through the lines
        $entries = [];
        for ($line = 0; $line < count($properties); $line++) {
            $split = explode(";", $properties[$line]);

            // Check if starts with str
            $notStr = substr(strtolower($split[0]), 0, 3) !== 'str';
            $notItem = substr(strtolower($split[0]), 0, 4) !== 'item';
            $notMod = substr(strtolower($split[0]), 0, 3) !== 'mod';

            // If not str and not item
            if ($notStr && $notItem && $notMod) {
                continue;
            }

            $data = [];
            $data['key'] = $split[0];
            $data['value'] = $split[1];

            $entries[] = $data;
        }



        return $entries;
    }

    private function createEntries(array $entries): void
    {
        foreach ($entries as $key => $value) {
            TranslateEntry::updateOrCreate(['key' => $value['key']], ['value' => $value['value']]);
        }
    }
}
