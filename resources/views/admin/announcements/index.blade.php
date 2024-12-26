@extends('layouts.adminnav')
<div style="background-color:#187C19; width:100%;position: fixed; color:white;"><h3 style="font-weight: bold; color:white; margin-left:2.80in;">Announcement</h3></div>

@section('content')


<a href="{{ route('admin.announcements.create') }}" class="btn shadow" style="margin-top: 50px; background-color:green; color:aquamarine;">Create Announcement</a>
<div class="container mt-5">

    <div class="card" style="width: 900px; margin: auto; box-shadow: 0 4px 20px rgba(0, 128, 0, 0.5);">
        <div class="card-body">
            <h3 class="text-center" style="font-weight: bold;">All Announcements</h3>
            <table class="table table-bordered mt-3">
                <thead class="thead-light">
                    <tr  class="table-light">
                        <th>Title</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($announcements as $announcement)
                        <tr>
                            <td>{{ $announcement->title }}</td>
                            <td>{{ $announcement->description }}</td>
                            <td>{{ $announcement->date }}</td>
                            <td>
                                <a href="{{ route('admin.announcements.edit', $announcement->id) }}" class="btn btn-sm btn-warning"  style="background-color: orange; color: white; border: 2px solid white; border-radius: 20%; width: 60px; height: 43px; font-size: medium;">Edit</a>
                                <form action="{{ route('admin.announcements.destroy', $announcement->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete btn-sm" onclick="return confirm('Are you sure you want to delete this resource allocation?');" style="background-color: red;color: white;border-radius: 20%;width: 60px;height: 40px;" >Delete</button>
                                    </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
