@extends('layouts.adminnav')
<div style="background-color:#187C19; width:100%;position: fixed; color:white;"><h3 style="font-weight: bold; color:white; margin-left:2.80in;">Email Announcement</h3></div>
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
    <div class="card shadow" style="width: 500px; height: 400px; padding: 20px; border-radius: 10px; margin-top:50px;" >
        <h1 class="text-center font-weight-bold" style="font-size: 24px; margin-bottom: 20px;">Send Email Announcement</h1>

       

        <form action="{{ route('send.announcement') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title"><strong>Title</strong></label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="message"><strong>Message</strong></label>
                <textarea name="message" id="message" class="form-control" rows="5" required></textarea>
            </div>
            <div class="text-center">
                <button type="submit" class="btn mt-3" style="height: 40px; background-color:green; color:aquamarine;">Send Announcement</button>
            </div>
        </form>
    </div>
</div>
@endsection
