@extends('layouts.adminnav')

<div style="background-color: green; width: 100%; position: fixed; color: white;">
    <h3 style="font-weight: bold; color: white; margin-left: 2.80in;">FARMER'S REGISTERED</h3>
</div>

@section('content')
<div class="container mt-5">
    <div class="row">
        <!-- Left-side Card -->
        <div class="col-md-4">
            <div class="card" style="width: 20rem; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);">
                <div class="card-body" style="background-color: white; color: black; border: 5px solid green;">
                    <h5 class="card-title text-center">TOTAL FARMER's REGISTERING</h5>
                    <h2 class="card-text text-center">{{ $totalregistered }}</h2>
                </div>
            </div>
        </div>

        <!-- Table inside a card -->
        <div class="col-md-12" style="margin-top: 30px;">
            <div class="card" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);">
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Location</th>
                                <th>Phone Number</th>
                                <th>Email</th>
                                <th>Land Size</th>
                                <th>Date of Registration</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user_registrations as $user_registration)
                                <tr>
                                    <td>{{ $user_registration->id }}</td>
                                    <td>{{ $user_registration->name }}</td>
                                    <td>{{ $user_registration->location }}</td>
                                    <td>{{ $user_registration->phone_number }}</td>
                                    <td>{{ $user_registration->gmail_account }}</td>
                                    <td>{{ $user_registration->land_size }}</td>
                                    <td>{{ $user_registration->date_of_registration }}</td>
                                    <td>
                                        <!-- Add to Farmers Table -->
                                        <a href="{{ route('panel.farmers.add', $user_registration->id) }}" class="btn btn-warning btn-sm">Add</a>

                                        <!-- Delete User -->
                                        <form action="{{ route('panel.user_registered.destroy', $user_registration->id) }}" method="POST" style="display:inline;" onsubmit="return confirmDeletion();">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
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
</div>

<script>
    function confirmDeletion() {
        return confirm("Are you sure you want to delete this record?");
    }
</script>
@endsection
