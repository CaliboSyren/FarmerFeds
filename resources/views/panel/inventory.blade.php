@extends('layouts.adminnav')
<div style="background-color:green; width:100%;position: fixed; color:white;">
    <h3 style="font-weight: bold; color:white; margin-left:2.80in;">INVENTORY LIST</h3>
</div>
@section('content')
<div class="container" style="margin-top: 50px;">
    <!-- Success or Error Messages -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Add New Resource Button -->
    <button class="btn mb-3" style="background-color:green; color:aqua;" data-bs-toggle="modal" data-bs-target="#addInventoryModal">Add Resource</button>

    <!-- Inventory Table -->
    <div class="card shadow-lg">
        <div class="card-body">
            <h5 class="card-title"></h5>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Resource Name</th>
                            <th>Quantity</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($inventory as $resource)
                        <tr>
                            <td>{{ $resource->name }}</td>
                            <td>{{ $resource->quantity }}</td>
                            <td>
                                <!-- Update Quantity Form -->
                                <form method="POST" action="{{ route('panel.inventory.update', $resource->id) }}" style="display:inline-block;">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" name="quantity" value="{{ $resource->quantity }}" min="0" required>
                                    <button class="btn btn-sm" style="background-color: greenyellow;">Update</button>
                                </form>

                                <!-- Delete Button -->
                                <form method="POST" action="{{ route('panel.inventory.destroy', $resource->id) }}" style="display:inline-block;" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add Inventory Modal -->
<div class="modal fade" id="addInventoryModal" tabindex="-1" aria-labelledby="addInventoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('panel.inventory.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addInventoryModalLabel">Add Resource</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Resource Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Resource Name" required>
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" name="quantity" class="form-control" min="0" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn" style="background-color: yellowgreen; color:black;">Add Resource</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
