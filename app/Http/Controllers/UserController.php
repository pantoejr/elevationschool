<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', [
            'title' => 'Users',
            'users' => $users
        ]);
    }

    public function create()
    {
        $roles = Role::all();
        return view('users.create', [
            'title' => 'Create User',
            'roles' => $roles
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => [
                'nullable',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {
                    if (!str_starts_with($value, '+231')) {
                        $fail('The phone number must start with +231');
                    }
                },
            ],
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'roleId' => 'required',
        ]);

        try {
            $photoPath = $request->file('photo') ? $request->file('photo')->store('photos', 'public') : null;

            $user = User::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'photo' => $photoPath,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'login_hint' => $request->input('password'),
                'status' => 'active',
                'created_by' => Auth::user()->name ?? 'NA',
                'updated_by' => Auth::user()->name ?? 'N/A',
            ]);

            $role = Role::findById($request->roleId);
            $user->assignRole($role);

            //SmsHelper::sendSms($user->phone, 'Welcome to our platform! Your login hint is: ' . $request->input('password'));
            //Mail::to($user->email)->send(new UserWelcomeEmail($user));

            return redirect()->route('users.index')->with('success', 'User created successfully.')
                ->with('flag', 'success');
        } catch (Exception $e) {
            return redirect()->back()->with('success', 'An error occurred while creating the user: ' . $e->getMessage())
                ->with('flag', 'danger');
        }
    }

    public function show(User $user)
    {
        $roles = Role::all();
        $user->load(['activities' => function ($query) {
            $query->latest()->take(5); // Load latest 5 activities
        }]);
        return view('users.show', [
            'title' => 'User Details',
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    public function edit($id)
    {
        $roles = Role::all();
        $user = User::findOrFail($id);
        return view('users.edit', [
            'title' => 'Edit User',
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    public function update(Request $request, User $user)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'roleId' => 'required',
        ]);

        try {
            $photoPath = $request->file('photo') ? $request->file('photo')->store('photos', 'public') : $user->photo;

            $user->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'photo' => $photoPath,
                'email' => $request->email,
                'password' => $request->password ? Hash::make($request->password) : $user->password,
                'login_hint' => $request->login_hint,
                'updated_by' => Auth::user()->name,
            ]);

            $role = Role::findById($request->roleId);
            $user->syncRoles($role);

            return redirect()->route('users.index')->with('success', 'User updated successfully.')
                ->with('flag', 'success');
        } catch (\Exception $e) {
            return redirect()->route('users.edit', $user->id)->with('success', 'An error occurred while updating the user: ' . $e->getMessage())
                ->with('flag', 'danger');
        }
    }

    public function destroy(User $user)
    {
        $user->delete();
        return to_route('users.index')
            ->with('success', 'User deleted successfully')
            ->with('flag', 'success');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('users.profile', [
            'title' => 'My Profile',
            'user' => $user,
        ]);
    }
}
