<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeclineGuideRequest;
use App\Models\Build;
use App\Services\BuildService;
use App\Services\ToastService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class BuildApproveController extends Controller
{
    use AuthorizesRequests;

    private ToastService $toastService;
    private BuildService $buildService;

    public function __construct(ToastService $toastService, BuildService $buildService)
    {
        $this->toastService = $toastService;
        $this->buildService = $buildService;
    }

    public function index()
    {
        $this->authorize('approve', Build::class);

        return Inertia::render('Build/Approve/Index', [
            'builds' => Build::waitingForApproval()->get(),
        ]);
    }

    public function approve(Build $build)
    {
        $this->authorize('approve', Build::class);

        $response = $this->buildService->approve($build, Auth::user());
        $rData = $response->getData(true);

        if ($rData['success']) {
            $this->toastService->setToast('success', 'Approved', $rData['message']);
        } else {
            $this->toastService->setToast('error', 'Approve Failed', $rData['message']);
        }

        return redirect()->route('build.wfa');
    }

    public function decline(Build $build, DeclineGuideRequest $request)
    {
        $this->authorize('approve', Build::class);

        $response = $this->buildService->decline($build, Auth::user(), $request->reason);
        $rData = $response->getData(true);

        if ($rData['success']) {
            $this->toastService->setToast('success', 'Declined', $rData['message']);
        } else {
            $this->toastService->setToast('error', 'Decline Failed', $rData['message']);
        }

        return redirect()->route('build.wfa');
    }
}
