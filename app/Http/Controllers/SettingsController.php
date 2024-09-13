<?php

namespace App\Http\Controllers;

use App\Services\SettingsService;
use App\Services\ToastService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class SettingsController extends Controller
{
    private ToastService $toastService;
    private SettingsService $settingsService;

    public function __construct(ToastService $toastService, SettingsService $settingsService)
    {
        $this->toastService = $toastService;
        $this->settingsService = $settingsService;
    }

    public function profile()
    {
        return Inertia::render('Settings/Profile');
    }

    public function updateProfilePhoto(Request $request)
    {
        $request->validate([
            'profile_photo' => 'required|image|mimes:jpg,png,jpeg,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=500,max_height=500',
        ]);

        // Store the file in the public directory and save the path
        $response = $this->settingsService->updateProfilePhoto($request->user(), $request->file('profile_photo'));
        $rData = $response->getData(true);

        if ($rData['success']) {
            $this->toastService->setToast('success', 'Profile picture', 'Update successful!');
        } else {
            $this->toastService->setToast('error', 'Profile picture', 'Failed to update profile picture');
        }

        return redirect()->back();
    }
}
