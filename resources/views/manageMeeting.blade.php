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
                <li class="breadcrumb-item active" aria-current="page">Manage Meeting</li>
            </ol>
        </div>
        @if (session('type'))
            <x-alert type="{{ session('type') }}" message="{{ session('message') }}"></x-alert>
        @endif
        <div class="card border-0 shadow">
            <div class="card-header">
                <div class="card-title p-2 m-0">manage Your Meetings</div>
            </div>
            <div class="card-body text-center">
                <table class="table table-striped table-hover table-bordered">
                    <thead class="table-primary">
                        <tr>
                            <th>
                                ID
                            </th>
                            <th>
                                Title
                            </th>
                            <th>
                                Date
                            </th>
                            <th>
                                Time
                            </th>
                            <th>
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 1;
                        @endphp
                        @foreach ($meetings as $meeting)
                            <tr>
                                <td>
                                    @php
                                        echo $count;
                                    @endphp
                                </td>
                                <td>
                                    {{ $meeting->title }}
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($meeting->meet_date)->format('Y-M-d') }}

                                </td>
                                <td>
                                    {{ date('g:i A', strtotime($meeting->meet_time)) }}
                                </td>
                                <td>
                                    <a href="{{ route('meeting.edit', $meeting->id) }}" class="btn btn-success"> Edit</a>
                                    <x-form action="{{ route('meeting.destroy', $meeting->id) }}" method="DELETE">

                                        <button class="btn btn-danger" type="submit">
                                            Delete
                                        </button>
                                    </x-form>
                                    <a href="{{ route('Notification.show', $meeting->id) }}" class="btn btn-warning"> View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection