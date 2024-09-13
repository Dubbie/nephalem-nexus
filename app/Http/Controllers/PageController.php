<?php

namespace App\Http\Controllers;

use App\Services\BuildService;
use Inertia\Inertia;

class PageController extends Controller
{
    private BuildService $buildService;

    public function __construct(BuildService $buildService)
    {
        $this->buildService = $buildService;
    }

    public function home()
    {
        $trending = $this->buildService->getTrending(8);
        $recent = $this->buildService->getRecent(5);

        return Inertia::render('Home', [
            'trending' => $trending,
            'recent' => $recent
        ]);
    }
}
