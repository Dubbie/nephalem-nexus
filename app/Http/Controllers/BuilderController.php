<?php

namespace App\Http\Controllers;

use App\Models\DiabloClass;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BuilderController extends Controller
{
    public function index()
    {
        $amazon = DiabloClass::where('name', 'Amazon')->first();
        $amazon->load('skillCategories', 'skillCategories.skills');
        return Inertia::render('Builder', [
            'amazon' => $amazon
        ]);
    }
}
