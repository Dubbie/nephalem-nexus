<?php

namespace Database\Seeders;

use App\Models\MagicPrefix;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemAffixSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MagicPrefix::truncate();

        $prefixData = $this->readPrefixFile();

        MagicPrefix::insert($prefixData);
    }

    private function readPrefixFile(): array
    {
        // Read the file line by line
        $data = file(storage_path('app/MagicPrefix.txt'), FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        // Loop through the lines
        $headers = explode("\t", $data[0]);
        $data = [];
        // dd($headers);
        for ($line = 1; $line < count($data); $line++) {
            $split = explode("\t", $data[$line]);
            $property = [];

            foreach ($split as $index => $value) {
                $property[$headers[$index]] = $value ?? null;
            }

            $data[] = $property;
        }

        return $data;
    }
}
