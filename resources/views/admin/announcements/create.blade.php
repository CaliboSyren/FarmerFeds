@extends('layouts.adminnav')
<div style="background-color:#187C19; width:100%;position: fixed; color:white;"><h3 style="font-weight: bold; color:white; margin-left:2.80in;">Announcement</h3></div>
@section('content')
<div class="container mt-5 d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow" style="width: 500px;">
        <div class="card-body">
            <h5 class="card-title text-center">Create Announcement</h5>
            <form action="{{ route('admin.announcements.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control" required></textarea>
                </div>

                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" name="date" id="date" class="form-control" required>
                </div>

                <button type="submit" class="btn " style="margin-top: 10px; background-color:green; color:aquamarine;">Create</button>
            </form>
        </div>
    </div>
</div>
@endsection