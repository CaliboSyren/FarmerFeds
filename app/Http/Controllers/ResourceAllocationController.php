<?php
namespace App\Http\Controllers;

use App\Models\Farmer;
use App\Models\ResourceAllocation;
use App\Models\InventoryResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResourceAllocationController extends Controller
{
    public function resources()
    {
        return view('panel.resources');
    }

    public function index(Request $request)
    {
        $farmers = Farmer::all();
        $resources = InventoryResource::all();
        $from = $request->input('from');
        $to = $request->input('to');
        
        // Ensure resource_types is always an array
        $resourceTypes = (array) $request->input('resource_type');
        $query = $request->input('query');

        $queryBuilder = ResourceAllocation::with('farmer');

        if ($from) {
            $queryBuilder->where('date', '>=', $from);
        }

        if ($to) {
            $queryBuilder->where('date', '<=', $to);
        }

        if (!empty($resourceTypes)) {
            $queryBuilder->whereIn('resource', $resourceTypes);
        }

        if ($query) {
            $queryBuilder->whereHas('farmer', function ($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%');
            });
        }

        $allocations = $queryBuilder->get();

        // Prepare data for the chart
        $monthlyData = ResourceAllocation::selectRaw('DATE_FORMAT(date, "%Y-%m") as month, SUM(quantity) as total')
            ->whereYear('date', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        return view('panel.resources', compact('allocations', 'farmers', 'monthlyData','resources'));
    }
    public function getInventoryQuantity($resource)
{
    $inventory = InventoryResource::where('resource', $resource)->first();

    if ($inventory) {
        return response()->json(['quantity' => $inventory->quantity]);
    } else {
        return response()->json(['quantity' => 0]);
    }
}
public function store(Request $request)
{
    $request->validate([
        'farmer_id' => 'required|exists:farmers,id',
        'resource' => 'required|string|exists:inventory_resources,name', 
        'date' => 'required|date',
        'quantity' => 'required|integer|min:1',
    ]);

    // Check if the farmer already has an allocation for the resource this month
    $existingAllocation = ResourceAllocation::where('farmer_id', $request->farmer_id)
        ->where('resource', $request->resource)
        ->whereMonth('date', now()->month)
        ->first();

    if ($existingAllocation) {
        return back()->withErrors(['error' => 'Farmer is only allowed one allocation per resource per month.']);
    }

    // Check if inventory has sufficient quantity
    $inventory = InventoryResource::where('name', $request->resource)->first();
    if (!$inventory || $inventory->quantity < $request->quantity) {
        return back()->withErrors(['error' => 'Insufficient quantity in inventory.']);
    }

    // Deduct the allocated quantity from the inventory
    $inventory->update(['quantity' => $inventory->quantity - $request->quantity]);

    // Create the resource allocation
    ResourceAllocation::create([
        'farmer_id' => $request->farmer_id,
        'resource' => $request->resource,
        'date' => $request->date,
        'quantity' => $request->quantity,
    ]);

    return redirect()->route('panel.resources')->with('success', 'Resource allocated successfully.');
}

   
public function destroy($id)
{
    // Find the allocation by ID
    $allocation = ResourceAllocation::find($id);

    // Check if the allocation exists
    if (!$allocation) {
        return back()->withErrors(['error' => 'Resource allocation not found.']);
    }

    // Return the allocated quantity back to the inventory
    $inventory = InventoryResource::where('name', $allocation->resource)->first();
    if ($inventory) {
        $inventory->update(['quantity' => $inventory->quantity + $allocation->quantity]);
    }

    // Delete the allocation
    $allocation->delete();

    return redirect()->route('panel.resources')->with('success', 'Resource allocation deleted successfully.');
}
public function getGraphData(Request $request)
    {
        // Determine the view (day, month, or year) based on the request
        $view = $request->get('view', 'day'); // Default to 'day'
        
        // Group by appropriate time unit based on the view
        $groupFormat = match ($view) {
            'day' => '%Y-%m-%d', // Group by day
            'month' => '%Y-%m',  // Group by month
            'year' => '%Y',      // Group by year
            default => '%Y-%m-%d', // Default to day
        };

        // Query the data
        $data = ResourceAllocation::select(
            DB::raw("DATE_FORMAT(date, '$groupFormat') as label"),
            'resource',
            DB::raw('SUM(quantity) as total_quantity')
        )
        ->groupBy('label', 'resource')
        ->orderBy('label', 'asc')
        ->get();

        // Return the data as JSON
        return response()->json($data);
    }

    public function update(Request $request, $id)
{
    // Validate input data
    $request->validate([
        'resource' => 'required|string',
        'date' => 'required|date',
        'quantity' => 'required|integer|min:1',
    ]);

    // Find the resource allocation by ID
    $allocation = ResourceAllocation::findOrFail($id);
    
    // Update the allocation
    $allocation->resource = $request->resource;
    $allocation->date = $request->date;
    $allocation->quantity = $request->quantity;
    $allocation->save();

    return redirect()->route('panel.resources')->with('success', 'Resource allocation updated successfully.');
}
}

