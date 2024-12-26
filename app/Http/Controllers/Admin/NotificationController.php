<?php

namespace App\Http\Controllers;

use App\Models\Farmers;
use App\Notifications\FarmerNotification;
use Illuminate\Http\Request;

class AdminNotificationController extends Controller
{
    public function sendNotification(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'message' => 'required|string|max:255',
        ]);

        // Get all farmers
        $farmers = Farmers::all();

        // Send notification to each farmer
        foreach ($farmers as $farmer) {
            $farmer->notify(new FarmerNotification($request->message));
        }

        return response()->json(['message' => 'Notifications sent successfully!']);
    }
}