<?php

namespace App\Http\Controllers;

use App\Models\Build;
use Inertia\Inertia;

class PageController extends Controller
{
    public function home()
    {
        // Find 5 random builds
        $trending = Build::active()->inRandomOrder()->limit(5)->get();
        $latest = Build::active()->latest()->limit(5)->get();
        return Inertia::render('Home', [
            'trending' => $trending,
            'latest' => $latest
        ]);
    }
}
