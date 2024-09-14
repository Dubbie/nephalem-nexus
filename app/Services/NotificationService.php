<?php

namespace App\Services;

use App\Models\Build;
use App\Models\User;
use App\Notifications\GuideApprovedNotification;
use App\Notifications\GuideDeclinedNotification;
use App\Notifications\GuidePendingNotification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class NotificationService
{
    /**
     * Notify administrators a build is waiting for approval
     *
     * @param Build $build
     * @return void
     */
    public function notifyPending(Build $build)
    {
        $admins = User::whereIn('role', ['ADMIN', 'DEVELOPER'])->get();
        Notification::send($admins, new GuidePendingNotification($build));

        Log::info("Guide #{$build->id} waiting for approval notification sent to admins.");
    }

    /**
     * Notify guide creator that a build was approved
     *
     * @param Build $build
     * @return void
     */
    public function notifyApproved(Build $build)
    {
        Notification::send($build->author, new GuideApprovedNotification($build));

        Log::info("Guide #{$build->id} approved by {$build->approvedBy->name}.");
    }

    /**
     * Notify guide creator that a build was declined
     *
     * @param Build $build
     * @return void
     */
    public function notifyDeclined(Build $build)
    {
        Notification::send($build->author, new GuideDeclinedNotification($build));

        Log::info("Guide #{$build->id} declined by {$build->declinedBy->name}.");
    }
}
