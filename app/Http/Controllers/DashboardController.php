<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;

// class DashboardController extends Controller
// {
//     public function admin()
//     {
//         return view('dashboard.admin');
//     }

//     public function user()
//     {
//         return view('dashboard.user');
//     }
// }
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin()
    {
        return view('dashboardadmin.admin'); // Create a view for admin
    }

    public function user()
    {
        return view('dashboarduser.user'); // Create a view for user
    }

    
}
