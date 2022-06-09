<?php

namespace VNCore\Horicon\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use VNCore\Horicon\Controllers\HoriconController;
use VNCore\Horicon\Http\Resources\SosFaqCommentCollection;
use VNCore\Horicon\Models\SosContact;

class ContactController extends HoriconController
{
    public function sendContact(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $data = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|max:5000',
        ]);

        $contact = new SosContact();
        $contact->fill($data);
        $contact->user_id = $user->id;
        $contact->save();

        return Response::json(['status' => 0]);
    }
}