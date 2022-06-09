<?php

namespace VNCore\Horicon\Controllers\Settings;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use VNCore\Horicon\Controllers\HoriconController;
use VNCore\Horicon\Rules\Password;

class AccountSettingsController extends HoriconController
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return view('horicon::settings.account', compact('user'));
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'old_password' => ['bail', 'required', new Password],
            'password' => 'required|confirmed||min:6|max:20|different:old_password',
            'password_confirmation' => 'required',
        ]);

        // Set data for user
        $user->password = bcrypt($validated['password']);
        $user->save();

        return back()->with('message', 'Updated successfully!');
    }
}
