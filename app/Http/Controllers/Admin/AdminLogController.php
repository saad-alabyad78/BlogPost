<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AdminLogController extends Controller
{
    public function show()
    {
        return view('admin.log.login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        //todo : ther user must be with admin role before attemping to log in

        if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            $request->session()->regenerate();

            return redirect('admin/');
        }

        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
    }
    public function logout(Request $request)
    {
        Auth::logout() ;

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('admin/');
    }
}
