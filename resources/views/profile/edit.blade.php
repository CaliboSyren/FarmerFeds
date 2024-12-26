@extends('layouts.usernav')

@section('content')
<div class="container">
    <h2>Edit Profile</h2>

    <!-- Display success or error messages -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Edit Profile Form -->
    <form action="{{ route('profile.update') }}" method="POST">
        @csrf

        <!-- Name Field -->
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email Field -->
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email Verification Date -->
        <div class="form-group">
            <label for="email_verified_at">Email Verified At</label>
            <input type="date" class="form-control" id="email_verified_at" name="email_verified_at" value="{{ old('email_verified_at', $user->email_verified_at) }}">
            @error('email_verified_at')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password Field -->
        <div class="form-group">
            <label for="password">New Password (Leave blank if not changing)</label>
            <input type="password" class="form-control" id="password" name="password">
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password Confirmation -->
        <div class="form-group">
            <label for="password_confirmation">Confirm New Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            @error('password_confirmation')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>
@endsection
