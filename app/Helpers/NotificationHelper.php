<?php

namespace App\Helpers;
use App\Models\Notification;

if (!function_exists('createNotification')) {
    function createNotification($title = null, $content, $type, $created_by, $classId = null)
    {
        $notification = new Notification();
        $notification->title = $title;
        $notification->content = $content;
        $notification->type = $type;
        $notification->created_by = $created_by;
        $notification->class_room_id = $classId;
        $notification->save();

        return $notification;
    }
}

if (!function_exists('sendNotificationToUser')) {
    function sendNotificationToUser($user_ids, Notification $notification)
    {
        foreach ($user_ids as $user_id) {
            $notification->users()->attach($user_id);
        }
    }
}
