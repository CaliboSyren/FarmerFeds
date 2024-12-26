@extends('layouts.adminnav')
<!-- <div style="background-color:green; width:100%; position: fixed; color:white;">
    <h3 style="font-weight: bold; color:white; margin-left:2.80in;">Announcements</h3> -->

@Section('content')
    <div class="container mt-5">
        <h1>Send Notification to Farmers</h1>

        @if(session('success '))
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

        <form action="{{ route('admin.sendNotification') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="message">Notification Message</label>
                <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary" style="margin-top: 50px;">Send Notification</button>
        </form>
    </div>
@endsection