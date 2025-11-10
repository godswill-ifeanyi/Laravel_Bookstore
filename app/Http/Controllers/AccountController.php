<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function login()
    {
        return view('account.login');
    }

    public function register()
    {
        return view('account.register');
    }

    public function register_user(Request $request) {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create a new user instance
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        // Log the user in (optional)
        Auth::login($user);

        // Redirect to a desired location, e.g., home page
        return redirect('dashboard/index')->with('success', 'Registration successful!');

    }

    public function login_user(Request $request) {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $request->email)->first();

        If (!$user) {
            return redirect()->back()->with('error', 'Account not found');
        }

        $pass_check = Hash::check($request->password, $user->password);

        if (!$pass_check) {
            return redirect()->back()->with('error', 'Password incorrect');
        }

        Auth::login($user);

        if (Auth::user()->role === 'admin') {
                return redirect('/admin/index')->with('success', 'Welcome Back '.$user->name);
            }


        return redirect('/dashboard/index')->with('success', 'Welcome Back '.$user->name);
    }
    
    public function logout_user(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logout successful!');
    }
    
}