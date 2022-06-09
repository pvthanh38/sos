<?php

namespace VNCore\Horicon\Services;

use App\User;
use Illuminate\Support\Facades\Notification;
use VNCore\Horicon\Models\Faq;
use VNCore\Horicon\Notifications\FaqNotification;

class FaqService extends HoriconService
{
    /**
     * @param Faq $faq
     */
    public function pushNotifications(Faq $faq)
    {
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin')->orWhere('name', 'staff');
        })->get();

        Notification::send($users, new FaqNotification($faq));
    }
}
