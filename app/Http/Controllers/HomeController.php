<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userRole = optional(auth()->user())->role;
        return view('home', compact('userRole'));
        // return view('home');
    }

     /**
     * Show the admin dashboard with total farmers count.
     */
    public function dashboard()
    {
        // You can filter by role if needed
       
        // dd('field');
        return view('admin.dashboard', compact('totalFarmers'));
    }
}
