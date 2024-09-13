<?php

namespace App\Http\Controllers;

use App\Models\Affix;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class AffixController extends Controller
{
    public function index()
    {
        // $affixes = Affix::where('type', 'prefix')
        //     ->with([
        //         'properties.stats',  // Load related stats
        //         'mods'
        //     ])
        //     ->orderBy('required_level', 'desc')
        //     ->get();

        // Fetch affixes with mods and properties
        $affixes = Affix::where('type', 'prefix')->with('properties.stats')->get();

        return Inertia::render('Affix/Index', [
            'affixes' => $affixes,
        ]);
    }
}
