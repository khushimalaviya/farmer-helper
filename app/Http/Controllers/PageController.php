<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    // public function __construct()
    // {
    //     // Apply auth middleware to these functions
    //     $this->middleware('auth')->only(['dashboard', 'profile']);
    // }

    public function home()
    {
        // $user = \App\Models\User::with('roles')->find(1);

        // // $user = \App\Models\User::find(1); // Replace with logged-in user's ID
        // dd($user->roles);

        // $userRole = optional(auth()->user())->role;
        return view('home');
    }

    

    public function about()
    {
        // Example data, replace this with your actual database data
        $teamMembers = [
            (object) [
                'name' => 'Rahul Patel',
                'image' => 'rahul.jpg',
                'role' => 'Farm Specialist',
            ],
            (object) [
                'name' => 'Priya Sharma',
                'image' => 'priya.jpg',
                'role' => 'Agricultural Scientist',
            ],
        ];

        return view('pages.about', compact('teamMembers'));
    }

    public function contact()
    {
        return view('pages.contact'); // resources/views/contact.blade.php
    }
    public function services()
    {
        return view('services'); // resources/views/services.blade.php
    }

    public function showProfileForm()
    {
        return view('farmers.profile');
    }

    // Show the farm data form
    public function showFarmDataForm()
    {
        return view('farmers.farm_data');
    }

    // Show the forgot password form
    public function showForgotPasswordForm()
    {
        return view('auth.forgot_password');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function farmers()
    {
        return view('admin.farmer');
    }
    public function crops()
    {
        return view('admin.crops');
    }
    public function weather()
    {
        return view('admin.weather');
    }


}
