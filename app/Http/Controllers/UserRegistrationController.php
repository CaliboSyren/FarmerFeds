<?php

namespace App\Http\Controllers;

use App\Models\UserRegistration;
use Illuminate\Http\Request;

class UserRegistrationController extends Controller
{
    public function ftr()
    {
        return view('panel.user_registered'); // Ensure the view exists in the 'resources/views/panel' folder
    }
    public function create()
    {
        return view('user.register'); // Show the registration form
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'gmail_account' => 'nullable|email|max:255',
            'land_size' => 'required|numeric',
            'date_of_registration' => 'required|date',
        ]);

        // Store the registration data
        UserRegistration::create($request->all());

        return redirect()->route('user.register')->with('success', 'Registration successful!'); // Redirect to the registration form
    }

    public function index()

    {
        $user_registrations = UserRegistration::all(); 
        return view('panel.user_registered', compact('user_registrations')); 

    }
    public function tregistered(){
        $user_registrations = UserRegistration::all(); 
        $totalregistered = UserRegistration::count(); 

        return view('panel.user_registered', compact('user_registrations','totalregistered')); 
    }


    public function edit($id)

    {

        $user_registrations = UserRegistration::findOrFail($id); // Find user by ID

        return view('panel.user_registered', compact('user_registrations')); // Show edit form

    }


    public function update(Request $request, $id)

    {

        // Validate the incoming request

        $request->validate([

            'name' => 'required|string|max:255',

            'location' => 'required|string|max:255',

            'phone_number' => 'required|string|max:15',

            'gmail_account' => 'nullable|email|max:255',

            'land_size' => 'required|numeric',

            'date_of_registration' => 'required|date',

        ]);


        // Update the user data

        $user_registrations = UserRegistration::findOrFail($id);

        $user_registrations->update($request->all());


        return redirect()->route('panel.user_registered')->with('success', 'User  updated successfully!'); // Redirect to the user list

    }


    public function destroy($id)

    {

        $user_registrations = UserRegistration::findOrFail($id);

        $user_registrations->delete(); // Delete the user


        return redirect()->route('panel.user_registered')->with('success', 'User  deleted successfully!'); // Redirect to the user list

    }
}


