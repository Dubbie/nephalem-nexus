<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\BuildService;
use Illuminate\Http\Request;

class BuildApiController extends Controller
{
    private BuildService $buildService;

    public function __construct(BuildService $buildService)
    {
        $this->buildService = $buildService;
    }

    public function fetch(Request $request)
    {
        return $this->buildService->getFiltered($request->all());
    }
}
