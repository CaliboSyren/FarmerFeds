<?php

// namespace App\Http\Controllers\Auth;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

// class LoginController extends Controller
// {
//     public function show()
//     {
//         return view('auth.login');
//     }

//     public function authenticate(Request $request)
//     {
//         $request->validate([
//             'email' => 'required|email',
//             'password' => 'required',
//             'role' => 'required',
//         ]);

//         $credentials = $request->only('email', 'password');

//         // Attempt to log in the user
//         if (Auth::attempt($credentials)) {
//             // Verify role matches
//             if (Auth::user()->role === $request->role) {
//                 return $request->role === 'admin'
//                     ? redirect()->route('dashboard.admin')
//                     : redirect()->route('dashboard.user');
//             }

//             // Logout and return role mismatch error
//             Auth::logout();
//             return back()->withErrors(['role' => 'Invalid role for this account.']);
//         }

//         // Return credential error
//         return back()->withErrors(['email' => 'Invalid credentials.']);
//     }
// }
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Check if the selected role matches the authenticated user's role
            if (Auth::user()->role === $request->role) {
                // Redirect based on role
                return $request->role === 'admin' 
                    ? redirect()->route('farmers.index') 
                    : redirect()->route('farmer.announcements.index');
            }

            // Logout and show an error if the role does not match
            Auth::logout();
            return back()->withErrors(['role' => 'The selected role is incorrect for this account.']);
            
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }
}
