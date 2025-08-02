<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle the login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // Validate input data
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string|min:6',
        ]);


        // Attempt to log in the user
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            // Log the successful login
            Log::info('User logged in: ' . Auth::user()->username);

            // Set welcome message in the session
            session()->flash('welcome', 'Selamat datang di website SIKETA-TI, ' . Auth::user()->name . '!');

            return redirect()->intended('/dashboard');
        }

        // Log the failed login attempt
        Log::warning('Failed login attempt for username: ' . $request->username);

        // Redirect back with error message if authentication fails
        return redirect()->back()->withErrors(['login' => 'username atau kata sandi salah'])->withInput();
    }

    /**
     * Logout the user.
     *
     * @return \Illuminate\Http\RedirectResponse
     */

    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate the session and regenerate token to avoid session fixation
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('status', 'Anda telah berhasil logout.');
    }

}
