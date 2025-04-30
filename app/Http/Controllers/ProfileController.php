<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // Show the user's profile page
    public function profile()
    {
        // Get the currently authenticated user
        $user = Auth::user();
        // dd($user);

        // Return the profile view with the user data
        return view('farmers.profile', compact('user'));
    }

    // Update the user's profile
    public function updateProfile(Request $request)
    {
        // Validate the form input
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contact_no' => 'required|digits:10',
            'profile_picture' => 'nullable|image|mimes:jpg,png,jpeg|max:4096',
        ]);

        // Get the currently authenticated user
        $user = Auth::user();

        // Handle the profile picture upload if it exists
        if ($request->hasFile('profile_picture')) {
            // Delete the old profile picture if it exists
            if ($user->profile_picture) {
                Storage::delete($user->profile_picture);
            }

            // Store the new profile picture in the public directory
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $path;  // Save the new profile picture path
        }

        // Update the user's name, email, and phone number
        $user->update([
            'username' => $request->username,
            'email' => $request->email,
            'contact_no' => $request->contact_no,
        ]);

        // Redirect back with a success message
        return back()->with('success', 'Profile updated successfully!');
    }
}
