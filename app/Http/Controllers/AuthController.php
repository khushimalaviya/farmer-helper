<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


class AuthController extends Controller
{
    // Show Registration Form
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Handle Registration
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:6|confirmed',
            'contact_no' => ['required', 'string', 'digits:10'],
        ]);

        try {
            // Create User
            $user = User::create([
                'username' => $request->username,  // Use 'username' instead of 'name'
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'contact_no' => $request->contact_no,
            ]);

            \DB::enableQueryLog();

            // Assign 'User' role (assuming role_id 2 is for 'User')
            \DB::table('user_roles')->insert([
                'user_id' => $user->id,
                'role_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Log::info('SQL Query:', \DB::getQueryLog());

            return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
        } catch (\Exception $e) {

            Log::error('Registration Error: ' . $e->getMessage());
            return back()->withErrors(['error' => 'An error occurred during registration. Please try again.']);
        }
    }

    // Show Login Form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle Login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            // // Check User Role and Redirect
            // if ($user->roles()->where('u_role', 'Admin')->exists()) {
            //     return redirect()->route('admin.dashboard')->with('success', 'Welcome to Admin Dashboard!');
            // } elseif ($user->roles()->where('u_role', 'User')->exists()) {
            //     return redirect()->route('home')->with('success', 'Welcome to User Dashboard!');
            // }

            return redirect()->route('home')->with('success', 'Login successful!');
        }

        return back()->withErrors(['email' => 'Invalid credentials. Please try again.']);
    }


    // Logout
    public function logout(Request $request)
    {
        // Auth::logout();
        Auth::guard('web')->logout(); // Explicitly specify the 'web' guard
        $request->session()->invalidate(); // Invalidate session
        $request->session()->regenerateToken(); // Regenerate CSRF token
        return redirect()->route('login')->with('success', 'Logged out successfully!');
    }

    // API: Handle User Registration
    public function apiRegister(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:6|confirmed',
            'contact_no' => ['required', 'string', 'digits:10'],
        ]);

        try {
            $user = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'contact_no' => $request->contact_no,
            ]);

            // Assign default role (example: role_id 2 = User)
            DB::table('user_roles')->insert([
                'user_id' => $user->id,
                'role_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Registration successful.',
                'user' => $user,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Registration failed.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // API: Handle User Login
    public function apiLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            // Generate token if using Laravel Sanctum or Passport
            $token = $user->createToken('API Token')->plainTextToken;

            return response()->json([
                'status' => true,
                'message' => 'Login successful.',
                'token' => $token,
                'user' => $user,
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Invalid credentials.',
        ], 401);
    }
}
