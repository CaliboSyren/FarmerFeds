<?php

namespace App\Http\Controllers;
use App\Models\UserRegistration;
use App\Models\Farmer;
use Illuminate\Http\Request;

class FarmersController extends Controller
{
    //
    public function farmers()
    {
        return view('panel.farmers');
    }

   
    public function addFarmer($id)
{
    // Fetch the user data from the UserRegistration table
    $user = UserRegistration::findOrFail($id);

    // Insert the user data into the Farmers table
    Farmer::create([
        'name' => $user->name,
        'location' => $user->location,
        'phone_number' => $user->phone_number,
        'gmail_account' => $user->gmail_account,
        'land_size' => $user->land_size,
        'date' => $user->date_of_registration,
    ]);

    // Optionally delete the user from the UserRegistration table
    $user->delete();

    // Redirect with success message
    return redirect()->route('panel.user_registered')->with('success', 'User successfully added to farmers.');
}
    
    public function index()
    {
        $farmers = Farmer::all(); // Fetch all farmers
        $totalFarmers = Farmer::count(); // Get the total number of farmers

        return view('panel.farmers', compact('farmers','totalFarmers')); 
    } 

     public function create()

    {

        return view('farmers.create'); // Create a view for adding a farmer

    }


    public function store(Request $request)

    {

        // Validate and store the farmer data

        $request->validate([

            'name' => 'required',

            'location' => 'required',

            'phone_number' => 'required',

            'gmail_account' => 'required|email',

            'land_size' => 'required|numeric',

            'date' => 'required|date',

        ]);


        Farmer::create($request->all());

        return redirect()->route('farmers.index')->with('success', 'Farmer added successfully.');

    }
    public function edit($id)

    {

        // Fetch the farmer by ID

        $farmer = Farmer::findOrFail($id);

        

        // Return the edit view with the farmer data

        return view('farmers.edit', compact('farmer'));

    }


    // Update the specified farmer in storage

    public function update(Request $request, $id)
{
    $farmer = Farmer::findOrFail($id);
    $farmer->name = $request->input('name');
    $farmer->location = $request->input('location');
    $farmer->phone_number = $request->input('phone_number');
    $farmer->gmail_account = $request->input('gmail_account');
    $farmer->land_size = $request->input('land_size');
    $farmer->date = $request->input('date');
    $farmer->save();
    
    return redirect()->route('farmers.index')->with('success', 'Farmer updated successfully');
}

    public function destroy(Farmer $farmer)

    {

        $farmer->delete();

        return redirect()->route('farmers.destroy')->with('success', 'Farmer deleted successfully.');

    }

    public function search(Request $request)
    {
        $query = $request->input('query');
    
        $farmers = Farmer::where('name', 'LIKE', "%{$query}%")
            ->orWhere('location', 'LIKE', "%{$query}%")
            ->orWhere('phone_number', 'LIKE', "%{$query}%")
            ->orWhere('gmail_account', 'LIKE', "%{$query}%")
            ->orWhere('land_size', 'LIKE', "%{$query}%")
            ->orWhere('date', 'LIKE', "%{$query}%")
            ->get();
    
        $totalFarmers = Farmer::count(); // Get the total number of farmers
    
        return view('panel.farmers', compact('farmers', 'totalFarmers'));
    }
}
