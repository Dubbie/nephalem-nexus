<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\UniqueItem;
use Inertia\Inertia;

class ItemController extends Controller
{
    public function index()
    {
        return Inertia::render(
            'Item/Index'
        );
    }

    public function unique()
    {
        $uniques = UniqueItem::with('item')->get()->map(function ($unique) {
            return $unique->normalize();
        });

        return Inertia::render(
            'Item/Unique',
            [
                'items' => $uniques
            ]
        );
    }

    public function show(Item $item)
    {
        $item = $item->itemable->normalize(true);

        return Inertia::render(
            'Item/Show',
            [
                'item' => $item
            ]
        );
    }
}
