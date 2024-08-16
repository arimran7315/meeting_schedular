@extends('manageMeeting')
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
                <li class="breadcrumb-item active" aria-current="page">View Meeting Status</li>
            </ol>
        </div>
        <div class="card border-0 shadow">
            <div class="card-header">
                <div class="card-title p-2 m-0">Basic Table</div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Send Notification</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 1;
                            $id = 0;
                        @endphp
                        @foreach ($users as $user)
                            <tr>
                                <td>
                                    @php
                                        echo $count;
                                    @endphp
                                </td>
                                <td>
                                    {{ $user->name }}
                                </td>
                                <td>
                                    @php
                                        $isNotificationSent = false;
                                    @endphp

                                    @if ($notifications == null)
                                        <x-form action="{{ route('Notification.store') }}" method="POST">
                                            <input type="hidden" value="{{ $user->id }}" name="user_id">
                                            <input type="hidden" value="{{ session('newMeetId') }}" name="meet_id">
                                            <button type="submit" class="btn btn-warning">Send Notification</button>
                                        </x-form>
                                    @else
                                        @foreach ($notifications as $notification)
                                            @if ($notification->user_id == $user->id)
                                                @php
                                                    $isNotificationSent = true;
                                                @endphp
                                                <button class="btn btn-success" disabled>Sent !</button>
                                            @break
                                        @endif
                                    @endforeach
                                    @if (!$isNotificationSent)
                                        <x-form action="{{ route('Notification.store') }}" method="POST">
                                            <input type="hidden" value="{{ $user->id }}" name="user_id">
                                            <input type="hidden" value="{{ session('newMeetId') }}" name="meet_id">
                                            <button type="submit" class="btn btn-warning">Send Notification</button>
                                        </x-form>
                                    @endif
                                @endif
                            </td>
                            <td>
                                @php
                                    $isUserNotified = false;
                                @endphp
                                @if (!empty($notifications))
                                    @foreach ($notifications as $notification)
                                        @if ($notification->user_id == $user->id)
                                            @php
                                                $isUserNotified = true;
                                            @endphp

                                            @if ($notification->status == 2)
                                                <span class="badge text-bg-success">Accept</span>
                                            @elseif ($notification->status == 0)
                                                <span class="badge text-bg-info">Not Responded yet</span>
                                            @else
                                                <span class="badge text-bg-danger">Reject</span>
                                            @endif
                                        @break
                                    @endif
                                @endforeach

                                @if (!$isUserNotified)
                                    <span class="badge text-bg-warning">Pending</span>
                                @endif

                            @endif
                        </td>

                    </tr>
                    @php
                        $count++;
                    @endphp
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>
@endsection