<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if(auth()->attempt($request->only('email', 'password')))
        {
            $request->session()->regenerate();
            // ✅ Log login activity
            activity('auth')
                ->causedBy(auth()->user())
                ->withProperties([
                    'ip' => request()->ip(),
                    'email' => $request->email])
                ->log('User logged in');

            return redirect()->intended(route('dashboard'));
        }

            return back()->with('error','Wrong email or password');

    }
    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        // ✅ Log login activity
        activity('auth')
            ->causedBy(auth()->user())
            ->withProperties([
                'ip' => request()->ip(),
            ])
            ->log('User logged out');

        return redirect()->route('login')->with('success', 'You have been Logout Successfully');
    }
}
