<?php

namespace App\Services;

use App\Models\Item;

class ItemService extends ApiService
{
    public function filter(array $data)
    {
        $query = Item::query();

        if (array_key_exists('name', $data)) {
            $query->where('name', 'like', '%' . $data['name'] . '%');
        }

        return $this->apiResponse($query->get(), "Items found!");
    }
}
