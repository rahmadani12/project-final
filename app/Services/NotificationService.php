<?php

namespace App\Services;

use App\Models\Notification;

class NotificationService
{
    public static function create(
        string $icon,
        string $title,
        string $message
    ): Notification {

        return Notification::create([
            'icon' => $icon,
            'title' => $title,
            'message' => $message,
            'is_read' => false,
        ]);
    }
}