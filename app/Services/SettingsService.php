<?php

namespace App\Services;

use App\Models\User;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;

class SettingsService extends ApiService
{
    public function updateProfilePhoto(User $user, UploadedFile $picture)
    {
        try {
            $path = $picture->store('pictures', 'public');

            // Save the path in the user's profile
            $user->profile_photo = $path;
            $user->save();

            Log::info('Profile picture updated successfully for user ' . $user->name);

            return $this->apiResponse($path, 'Profile picture updated successfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());

            return $this->apiResponse(null, 'Error while updating profile picture', 500, false);
        }
    }
}
