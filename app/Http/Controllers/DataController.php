<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataController extends Controller
{
    // Display the form
    public function index()
    {
        return view('index');
    }

    // Handle Form Submission
    public function submit(Request $request)
    {
        $jsValue = $request->input('jsValue');
        return "Form Submitted! Received Value: " . $jsValue;
    }
}
