<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\UniqueItem;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UniqueSeeder extends FromFileSeeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UniqueItem::query()->delete();
        $data = $this->readFile('app/UniqueItems.txt');
        $this->createUniques($data);
    }

    /**
     * @param array $data
     */
    private function createUniques(array $data): void
    {
        foreach ($data as $unique) {
            $this->createUnique($unique);
        }
    }

    /**
     * @param array $unique
     */
    private function createUnique(array $unique): void
    {
        DB::beginTransaction();

        try {
            $base = Item::where('code', $unique['code'])->first();

            if ($base === null) {
                throw new Exception('Base item not found! ' . $unique['code']);
            }
            $name = $unique['index'];
            $slug = str_replace(' ', '-', strtolower($name));

            $uniqueItem = UniqueItem::create([
                'base_item_id' => $base->id,
            ]);

            for ($i = 1; $i <= 12; $i++) {
                if ($unique["prop{$i}"] !== '') {
                    $uniqueItem->uniqueProperties()->create([
                        'code' => $unique["prop{$i}"],
                        'parameter' => $unique["par{$i}"],
                        'min' => $unique["min{$i}"],
                        'max' => $unique["max{$i}"],
                        'property_number' => $i,
                    ]);
                }
            }

            $item = new Item([
                'name' => $name,
                'code' => $slug,
                'type' => $base->type,
                'gfx' => $unique['invfile'],
                'width' => $base->width,
                'height' => $base->height,
                'level_requirement' => $unique['lvl req'],
                'max_sockets' => $base->max_sockets,
            ]);

            $uniqueItem->item()->save($item);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
        }
    }
}
