@extends('layouts.usernav')

<div style="background-color:green; width:100%; position: fixed; color:white;">
    <h3 style="font-weight: bold; color:white; margin-left:2.80in;">REGISTRATION</h3>
</div>

@section('content')
@if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
<div class="container mt-5 d-flex justify-content-center">
    <div class="card shadow" style="width: 600px; height: 450px; margin-top: 50px;">
  
        <div class="card-body">
            <h1 class="card-title text-center">Farmers Registration</h1>
            <p style="color: red;">"Reminder: Register once. Your data will be reviewed. Avoid duplicate registrations. Thank you!"</p>
            <form action="{{ route('user.store') }}" method="POST">
                @csrf
                <div class="row" style="height: 100%;">
                    <!-- Left Column -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="location">Location</label>
                            <input type="text" class="form-control" id="location" name="location" required>
                        </div>
                        <div class="form-group">
                            <label for="phone_number">Phone Number</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" required maxlength="11" pattern="\d{11}" title="Please enter a valid 11-digit phone number">
                        </div>
                    </div>
                    <!-- Right Column -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="gmail_account">Gmail</label>
                            <input type="email" class="form-control" id="gmail_account" name="gmail_account" required>
                        </div>
                        <div class="form-group">
                            <label for="land_size">Land Size (HA)</label>
                            <input type="number" class="form-control" id="land_size" name="land_size" required>
                        </div>
                        <div class="form-group">
                            <label for="date_of_registration">Date of Registration</label>
                            <input type="date" class="form-control" id="date_of_registration" name="date_of_registration" required>
                        </div>
                        
                    </div>
                    <div class="text-center">
                    <button type="submit" class="btn" style="background-color: green; color:aqua; margin-bottom:50px;">Register Now</button>
                </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection