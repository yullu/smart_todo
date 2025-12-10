<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
        $register = new User();
        $register->name = $request->name;
        $register->email = $request->email;
        $register->password = Hash::make($request->password);
        $register->save();

        // 🔹 Log audit trail
        activity('registration')
            ->causedBy(auth()->user())
            ->performedOn($register)
            ->withProperties([
                'activated_date' => $register->name,
                'status' => $register->email,
                'ip' => request()->ip(),
            ])
            ->log('New user registered');

        return redirect()->route('register')->with('success', 'Account Registration Successful!');
    }
}
