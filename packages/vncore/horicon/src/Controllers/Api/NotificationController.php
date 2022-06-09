<?php

namespace VNCore\Horicon\Controllers\Api;

use Illuminate\Http\Request;
use VNCore\Horicon\Controllers\HoriconController;
use VNCore\Horicon\Http\Resources\SosNotificationCollection;
use VNCore\Horicon\Models\SosNotification;

class NotificationController extends HoriconController
{
    public function index(Request $request)
    {
        $perPage = $request->get('number', 20);
        $notifications = SosNotification::orderBy('created_at', 'desc')->paginate($perPage);
        return new SosNotificationCollection($notifications);
    }
}