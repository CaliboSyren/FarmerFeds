<?php

namespace App\Http\Controllers;

use App\Models\InventoryResource;
use Illuminate\Http\Request;

class InventoryResourceController extends Controller
{
    public function inventory(){
        return view('panel.inventory');
    }
    public function index()
    {
        // Fetch all inventory resources
        $inventory = InventoryResource::all();
        return view('panel.inventory', compact('inventory'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
        ]);

        // Create new inventory resource
        InventoryResource::create([
            'name' => $request->name,
            'quantity' => $request->quantity,
        ]);

        return redirect()->route('panel.inventory')->with('success', 'Resource added successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:0',
        ]);

        $resource = InventoryResource::findOrFail($id);
        $resource->quantity = $request->quantity;
        $resource->save();

        return redirect()->route('panel.inventory')->with('success', 'Resource updated successfully.');
    }

    public function destroy($id)
    {
        $resource = InventoryResource::findOrFail($id);
        $resource->delete();

        return redirect()->route('panel.inventory')->with('success', 'Resource deleted successfully.');
    }
}
