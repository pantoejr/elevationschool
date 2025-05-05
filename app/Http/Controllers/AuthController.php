<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login', [
            'title' => 'Login',
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            if ($user->status !== 'active') {
                return redirect()->back()->with('msg', 'The username or password provided is incorrect.')
                    ->with('flag', 'error');
            }


            Auth::login($user);
            activity()->causedBy(Auth::user())->performedOn($user)->withProperties(['ip' => request()->ip()])->log('Authenticated Successfully');

            return redirect()->route('home.index')
                ->with('success', 'Logged in successfully.')
                ->with('flag', 'success');
        }

        return redirect()->back()
            ->with('msg', 'The username or password provided is incorrect.')
            ->with('flag', 'error');
    }

    public function showChangePasswordForm()
    {

        return view('auth.changepassword', [
            'title' => 'Change Password',
        ]);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->login_hint = $request->new_password;
        $user->save();
        activity()->causedBy(Auth::user())->withProperties(['ip' => request()->ip()])->log('Password Changed');
        return redirect()->route('home.index')->with('success', 'Password changed successfully.')
            ->with('flag', 'success');
    }

    public function showLinkRequestForm()
    {
        return view('auth.resetpassword', [
            'title' => 'Reset Password',
        ]);
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.resetpasswordconfirm')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->login_hint = $password;
                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('msg', 'You have been logged out successfully.')
            ->with('flag', 'success');
    }
}
