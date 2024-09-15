<?php

namespace App\Http\Controllers;

use App\Models\Affix;
use Illuminate\Http\Request;

class AffixController extends Controller
{
    public function test()
    {
        $affixes = Affix::all();
        dd($affixes[0]);
    }
}
