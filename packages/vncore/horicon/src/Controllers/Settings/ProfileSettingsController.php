<?php

namespace VNCore\Horicon\Controllers\Settings;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use VNCore\Horicon\Controllers\HoriconController;

class ProfileSettingsController extends HoriconController
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $identifiers = timezone_identifiers_list();
        foreach ($identifiers as $identifier) {
            $timezones[$identifier] = $identifier;
        }

        $user = Auth::user();
        return view('horicon::settings.profile', compact('user', 'timezones'));
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'bail|required|max:255',
            'title' => 'required|max:255',
            'avatar' => 'file|image',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'timezone' => 'required|in:' . implode(',', timezone_identifiers_list()),
            'bio' => 'nullable',
        ]);

        // Upload avatar for user
        $user->addImageFromRequest();

        // Set data for user
        $user->name = $validated['name'];
        $user->title = $validated['title'];
        $user->email = $validated['email'];
        $user->timezone = $validated['timezone'];
        $user->bio = $validated['bio'];
        $user->save();

        return back()->with('message', 'Updated successfully!');
    }
}
