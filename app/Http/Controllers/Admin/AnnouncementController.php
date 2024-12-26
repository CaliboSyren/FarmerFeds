<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AnnouncementMail;

class AnnouncementController extends Controller
{
    public function announcement(){
        return view('admin.announcements.index');
    }
    
    public function index()
    {
        $announcements = Announcement::all();
        // dd($announcements);
        return view('admin.announcements.index', compact('announcements'));
    }

    public function create()
    {
        return view('admin.announcements.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'date' => 'required|date',
        ]);

        $announcement = Announcement::create($request->all());

        $farmers = User::where('role', 'farmer')->get();

        // foreach ($farmers as $farmer) {
        //     Mail::to($farmer->email)->send(new AnnouncementMail(
        //         $announcement->title,
        //         $announcement->description,
        //         $announcement->date
        //     ));
        // }

        return redirect()->route('admin.announcements.index')->with('success', 'Announcement created and emails sent successfully.');
    }

    public function edit(Announcement $announcement)
    {
        return view('admin.announcements.edit', compact('announcement'));
    }

    public function update(Request $request, Announcement $announcement)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'date' => 'required|date',
        ]);

        $announcement->update($request->all());

        return redirect()->route('admin.announcements.index')->with('success', 'Announcement updated successfully.');
    }

    public function destroy(Announcement $announcement)
    {
        $announcement->delete();

        return redirect()->route('admin.announcements.index')->with('success', 'Announcement deleted successfully.');
    }
}
