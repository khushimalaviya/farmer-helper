<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Farmer;
use Illuminate\Http\Request;

class FarmerCrudController extends Controller
{
    // Show all farmers
    public function index()
    {
        // Fetching all farmers from the database
        $farmers = user::all();
        // dd($farmers);

        // Returning the view with farmers data
        return view('admin.farmers.index', compact('farmers'));
    }

    // Show the form to create a new farmer
    public function create()
    {
        return view('admin.farmers.create');
    }

    // Store a new farmer
    public function store(Request $request)
    {
        // Validating the form data
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:farmers,email',
            'contact' => 'required|string|max:20',
        ]);

        // Creating a new farmer record
        User::create($validated);

        // Redirecting back with a success message
        return redirect()->route('admin.farmers.index')->with('success', 'Farmer created successfully.');
    }

    // Show the form to edit an existing farmer
    public function edit($farmer)
    {
        // dd($farmer);
        $farmer = User::find($farmer);
        // dd(';iv');
        return view('admin.farmers.edit', compact('farmer'));
    }

    // Update an existing farmer
    public function update(Request $request,  $farmer)
    {
        // dd($request);
        // Validating the form data
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email',
            'contact' => 'required|string|max:20',
        ]);

        // Updating the farmer record
        $farmer = User::find($farmer);
        $farmer->username = $validated['username'];
        $farmer->email = $validated['email'];
        $farmer->contact_no = $validated['contact'];
        $farmer->save();

        // Redirecting back with a success message
        return redirect()->route('admin.farmers')->with('success', 'Farmer updated successfully.');
    }

    // Delete an existing farmer
    public function destroy($farmer)
    {
        // dd($farmer);
        $farmer = User::find($farmer);

        // Deleting the farmer record
        $farmer->delete();


        // Redirecting back with a success message
        return redirect()->route('admin.farmers')->with('success', 'Farmer deleted successfully.');
    }
}