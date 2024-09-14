<?php

namespace App\Notifications;

use App\Models\Build;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class GuidePendingNotification extends Notification
{
    use Queueable;

    protected $build;

    /**
     * Create a new notification instance.
     */
    public function __construct(Build $build)
    {
        $this->build = $build;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the database representation of the notification.
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'user' => $this->build->author->name,
            'message' => 'Submitted a guide for approval.',
            'link' => route('build.wfa'),
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
