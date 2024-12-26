@extends('layouts.adminnav')
<div style="background-color:green; width:100%;position: fixed; color:white;"><h3 style="font-weight: bold; color:white; margin-left:2.80in;">PROFILE</h3></div>
@section('content')
<div class="container">

    <h1>Edit Profile</h1>


    @if(session('success'))

        <div class="alert alert-success">{{ session('success') }}</div>

    @endif


    @if($errors->any())

        <div class="alert alert-danger">

            <ul>

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <form action="{{ route('profile.search') }}" method="POST">

        @csrf

        <div class="form-group">

            <label for="username">Enter Username or Email</label>

            <input type="text" name="username" class="form-control" required>

        </div>

        <button type="submit" class="btn btn-primary">Search</button>

    </form>


    @if(isset($user))

        <div class="card mt-4">

            <div class="card-body">

                <form action="{{ route('profile.update') }}" method="POST">

                    @csrf

                    <input type="hidden" name="user_id" value="{{ $user->id }}">


                    <div class="form-group">

                        <label for="name">Name</label>

                        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>

                    </div>


                    <div class="form-group">

                        <label for="email">Email</label>

                        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>

                    </div>


                    <div class="form-group">

                        <label for="password">Password</label>

                        <input type="password" name="password" class="form-control" placeholder="Leave blank to keep current password">

                    </div>


                    <div class="form-group">

                        <label for="confirm_password">Confirm Password</label>

                        <input type="password" name="confirm_password" class="form-control" placeholder="Leave blank to keep current password">

                    </div>


                    <button type="submit" class="btn btn-success"> Update Profile</button>

                </form>

            </div>

        </div>

    @endif

</div>
@endsection