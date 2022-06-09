<?php

namespace VNCore\Horicon\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use VNCore\Horicon\Controllers\HoriconController;
use VNCore\Horicon\Models\Role;

class UserController extends HoriconController
{
    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = User::query();
        $query->whereHas('roles', function ($query) {
            $query->where('name', 'admin');
            $query->orWhere('name', 'staff');
            $query->orWhere('name', 'notification');
        });

        $q = $request->get('q');
        if ($q) {
            $query->search($q);
        }

        $users = $query->orderUpdated()->paginate(20);

        return view('horicon::users.index', compact('users'));
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::orderUpdated()->get()->pluck('label', 'id');
        return view('horicon::users.create', compact('roles'));
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'bail|required|max:100',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable',
            'password' => 'required',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = new User();
        $user->fill($validated);
        $user->save();
        $user->roles()->attach($validated['roles']);

        return back()->with('message', 'Created successfully!');
    }

    /**
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::orderUpdated()->get()->pluck('label', 'id');
        $user->password = '';
        return view('horicon::users.edit', compact('user', 'roles'));
    }

    /**
     * @param Request $request
     * @param User    $user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'bail|required|max:100',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->where(function ($query) use ($user) {
                    $query->where('id', '!=', $user->id);
                    return $query;
                }),
            ],
            'phone' => 'nullable',
            'password' => 'sometimes',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
        ]);

        $password = $validated['password'];
        if ($password) {
            $validated['password'] = Hash::make($password);
        } else {
            unset($validated['password']);
        }

        $user->fill($validated);
        $user->save();
        $user->roles()->sync($validated['roles']);

        return back()->with('message', 'Updated successfully!');
    }

    /**
     * @param User $user
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('message', 'Deleted successfully!');
    }
}
