<?php

namespace App\Http\Controllers;

use App\Enums\Roles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;


class PasswordController extends Controller
{
    public function showForgetForm()
    {
        return view('password.email');
    }

    public function sendResetEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::broker('users')->sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    }
    public function showResetForm(Request $request , $token)
    {
        return view('password.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function reset(Request $request)
    {
        
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::broker('users')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();
            }
        );

        $user = User::where('email' , $request->email)->first() ;

        return $status === Password::PASSWORD_RESET
                    ? 
                    (
                        $user->is_admin()?
                        redirect()->route('admin.login')->with('status', __($status))
                        :
                        redirect()->route('user.login')->with('status', __($status))
                    )
                    : back()->withErrors(['email' => [__($status)]]);
    }

}
