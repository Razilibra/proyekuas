<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Show the registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle the registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        // Validasi data input
        $request->validate([
            'username' => 'required|string|unique:users,username',
            'name' => 'required|string|unique:users,name',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|confirmed|min:6',
        ]);

        // Buat pengguna baru
        User::create([
            'username' => $request->username,
            'name'=>$request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),

        ]);

        return redirect('/login')->with('success', 'Registration successful! Please login.');
    }
}
