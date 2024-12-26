<?php
// // app/Http/Controllers/AdminNotificationController.php
// namespace App\Http\Controllers;

// use App\Models\Farmer; // Ensure this is correct
// use App\Notifications\FarmerNotification;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Notification;

// class AdminNotificationController extends Controller
// {
//     public function create()
//     {
//         return view('admin.notifications.create');
//     }

//     public function send(Request $request)
//     {
//         $request->validate(['message' => 'required|string']);

//         try {
//             $message = $request->input('message');
//             $farmer = Farmer::all();
//             Notification::send($farmer, new FarmerNotification($message));
//             return redirect()->back()->with('success', 'Notifications sent successfully!');
//         } catch (\Exception $e) {
//             return redirect()->back()->with('error', 'Failed to send notifications: ' . $e->getMessage());
//         }
//     }
// }


//not use
namespace App\Http\Controllers;

use App\Mail\NotificationEmail;
use App\Models\Farmers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminNotificationController extends Controller
{
    public function create()
    {
        return view('admin.notifications.create'); // Ensure this view exists
    }

    public function sendNotification(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'message' => 'required|string|max:255', // Ensure it's a string
        ]);
    
        // Get all farmers
        $farmeruser = Farmers::all();
    
        // Send notification to each farmer
        foreach ($farmeruser as $farmer) {
            Mail::to($farmer->email)->send(new NotificationEmail($request->message));
        }
    
        return redirect()->back()->with('success', 'Notifications sent successfully!');
    }
}