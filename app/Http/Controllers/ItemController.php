<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class ItemController extends Controller
{
    public function index()
    {
        return Inertia::render(
            'Item/Index'
        );
    }
}
