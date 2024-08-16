@extends('masterLayout.layout')
@section('content')
    <div class="container-fluid">
        <div class="mt-4 mb-5"
            style="
        --bs-breadcrumb-divider: url(
          &#34;data:image/svg + xml,
          %3Csvgxmlns='http://www.w3.org/2000/svg'width='8'height='8'%3E%3Cpathd='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z'fill='%236c757d'/%3E%3C/svg%3E&#34;
        );
      "
            aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Schedule Meeting</li>
            </ol>
        </div>
        <div class="card border-0 shadow">
            <div class="card-header">
                <div class="card-title p-2 m-0">Schedule a New Meeting</div>
            </div>
            <div class="card-body">
                <x-form action="{{ route('meeting.update', $meeting->id) }}" method="PUT">
                    @if (session('type'))
                        <x-alert type="{{ session('type') }}" message="{{ session('message') }}"></x-alert>
                    @endif
                    <div class="container mt-5 px-5">
                        <div class="row mt-4">
                            <div class="col mb-3">
                                <label for="subject">Meeting Title</label>
                                <input type="text" class="form-control" placeholder="Title of meeting" name="title"
                                    value="{{ $meeting->title }}">
                            </div>
                            <div class="col mb-3">
                                <label for="subject">Date</label>
                                <input type="date" class="form-control" placeholder="Add title of meeting" name="date"
                                    value="{{ \Carbon\Carbon::parse($meeting->meet_date)->format('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col mb-3">
                                <label for="subject">Time</label>
                                <input type="time" class="form-control" placeholder="Add title of meeting" name="time"
                                    value="{{ date('H:i', strtotime($meeting->meet_time)) }}">
                            </div>
                            <div class="col mb-3">
                                <label for="subject">Duration</label>
                                <input type="text" class="form-control" placeholder="1 hour" name="duration"
                                    value="{{ $meeting->meet_duration }}">
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-6 mb-3 w-50 m-auto">
                                <label for="subject">Location</label>
                                <input type="text" class="form-control" placeholder="Add location" name="location"
                                    value="{{ $meeting->meet_location }}">
                            </div>
                        </div>
                        <div class="row mt-4">
                            <input type="submit" value="Update" class="w-25 m-auto btn btn-primary" name="submit">
                        </div>
                    </div>
                </x-form>
            </div>
        </div>
    </div>
@endsection