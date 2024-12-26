@extends('layouts.usernav')

<div style="background-color:green; width:100%; position: fixed; color:white;">
    <h3 style="font-weight: bold; color:white; margin-left:2.80in;">ANNOUNCEMENTS</h3>
</div>

@section('content')
<div class="container mt-5" >
    <div class="row" style="margin-top: 70px;">
        <!-- Upcoming Announcements Card -->
        <div class="col-md-6">
            <h3 class="text-center mb-4" style="font-weight: bold;">Upcoming Announcements</h3>
            <div class="card" style="background-color: #8DC17E;"> <!-- Light green background -->
                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($upcoming as $announcement)
                            <li class="list-group-item">
                                <a href="{{ route('farmer.announcements.show', $announcement->id) }}" class="text-decoration-none">
                                    {{ $announcement->title }} - {{ $announcement->date }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- Past Announcements Card -->
        <div class="col-md-6">
            <h3 class="text-center mb-4" style="font-weight: bold;">Past Announcements</h3>
            <div class="card" style="background-color: #ff6b6b;"> <!-- Light red background -->
                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($past as $announcement)
                            <li class="list-group-item">
                                <a href="{{ route('farmer.announcements.show', $announcement->id) }}" class="text-decoration-none">
                                    {{ $announcement->title }} - {{ $announcement->date }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection