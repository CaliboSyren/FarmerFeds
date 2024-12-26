<?php

namespace App\Http\Controllers;
use App\Mail\AnnouncementMail;
use App\Models\Farmer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class AnnouncementControllers extends Controller
{
    public function announce()
    {
        return view('send-announcement');
    }
    public function sendAnnouncement(Request $request)
{
    // Validate the request
    $request->validate([
        'title' => 'required|string|max:255',
        'message' => 'required|string',
    ]);

    // Fetch all farmer Gmail accounts
    $farmers = Farmer::pluck('gmail_account')->toArray();

    // Prepare the announcement details
    $announcement = [
        'title' => $request->title,
        'message' => $request->message,
    ];

    // Send email to all farmers
    foreach ($farmers as $email) {
        Mail::to($email)->send(new AnnouncementMail($announcement));
    }

    return back()->with('success', 'Announcement sent successfully!');
}

}
