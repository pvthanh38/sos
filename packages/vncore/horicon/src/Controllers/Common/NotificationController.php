<?php

namespace VNCore\Horicon\Controllers\Common;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use VNCore\Horicon\Controllers\HoriconController;
use VNCore\Horicon\Models\Faq;
use VNCore\Horicon\Notifications\FaqNotification;

class NotificationController extends HoriconController
{
    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $notifications = $user->notifications()->paginate(20);

        return view('horicon::notifications.index', compact('notifications'));
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function readAll(Request $request)
    {
        $notifications = Auth::user()->unreadNotifications;
        $notifications->markAsRead();

        return back()->with('message', 'Updated successfully!');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function getUnread(Request $request)
    {
        return view('horicon::notifications.get_unread');
    }
}
