@extends('layouts.adminnav')

<div style="background-color:#187C19; width:100%; position: fixed; color:white;">
    <h3 style="font-weight: bold; color:white; margin-left:2.80in;">Announcement</h3>
</div>

@section('content')
<div class="container mt-5 d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow" style="width: 500px; height: 400px;">
        <div class="card-body">
            <h5 class="card-title text-center">Edit Announcement</h5>
            <form action="{{ route('admin.announcements.update', $announcement->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ $announcement->title }}" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control" required>{{ $announcement->description }}</textarea>
                </div>

                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" name="date" id="date" class="form-control" value="{{ $announcement->date }}" required>
                </div>

                <button type="submit" class="btn b" style="margin-top: 50px; background-color:green; color:aquamarine;">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection