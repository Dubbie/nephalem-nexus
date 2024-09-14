<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationApiController extends Controller
{
    public function fetch(Request $request)
    {
        return response()->json([
            'notifications' => $request->user()->notifications
        ]);
    }

    public function fetchUnread(Request $request)
    {
        return response()->json([
            'notifications' => $request->user()->unreadNotifications
        ]);
    }

    public function read(Request $request, $notification)
    {
        $request->user()->notifications()->find($notification)->markAsRead();
        return response()->json([
            'notifications' => $request->user()->unreadNotifications,
            'message' => 'Notification marked as read'
        ]);
    }

    public function readAll(Request $request)
    {
        $request->user()->unreadNotifications->markAsRead();
        return response()->json([
            'notifications' => $request->user()->unreadNotifications,
            'message' => 'All notifications marked as read'
        ]);
    }

    public function clearAll(Request $request)
    {
        $request->user()->notifications()->delete();
        return response()->json([
            'notifications' => $request->user()->notifications,
            'message' => 'All notifications cleared'
        ]);
    }
}
