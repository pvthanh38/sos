<?php

namespace VNCore\Horicon\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use VNCore\Horicon\Controllers\HoriconController;
use VNCore\Horicon\Models\Role;

class EnvController extends HoriconController
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function distance()
    {
        $distance = env('LOCATION_DISTANCE');
        return view('horicon::env.distance', compact('distance'));
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function distanceStote(Request $request)
    {
        $validated = $request->validate([
            'distance' => 'required|integer',
        ]);

        $key = 'LOCATION_DISTANCE';
        $value = $validated['distance'];

        $path = app()->environmentFilePath();
        $escaped = preg_quote('=' . env($key), '/');

        file_put_contents($path, preg_replace(
            "/^{$key}{$escaped}/m",
            "{$key}={$value}",
            file_get_contents($path)
        ));

        return back()->with('message', 'Updated successfully!');
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function date()
    {
        $date = env('LOCATION_DATE');
        return view('horicon::env.date', compact('date'));
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function dateStote(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|integer',
        ]);

        $key = 'LOCATION_DATE';
        $value = $validated['date'];

        $path = app()->environmentFilePath();
        $escaped = preg_quote('=' . env($key), '/');

        file_put_contents($path, preg_replace(
            "/^{$key}{$escaped}/m",
            "{$key}={$value}",
            file_get_contents($path)
        ));

        return back()->with('message', 'Updated successfully!');
    }
}
