<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\BuildService;
use App\Services\ToastService;
use Illuminate\Http\Request;

class BuildApiController extends Controller
{
    private BuildService $buildService;
    private ToastService $toastService;

    public function __construct(BuildService $buildService, ToastService $toastService)
    {
        $this->buildService = $buildService;
        $this->toastService = $toastService;
    }

    public function fetch(Request $request)
    {
        $response = $this->buildService->getFiltered($request->all());
        $rData = $response->getData(true);

        if (!$rData['success']) {
            $this->toastService->setToast('error', 'Fetch Failed', $rData['message']);
        }

        return $response;
    }
}
