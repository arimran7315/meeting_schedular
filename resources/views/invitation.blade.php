@extends('masterLayout.layout')
@section('content')
    <input type="hidden" value="" id="id">
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
                <li class="breadcrumb-item active" aria-current="page">Home</li>
            </ol>
        </div>
        <div class="card border-0 shadow">
            <div class="card-header">
                <div class="card-title p-2 m-0">New Meetings Invitations</div>
            </div>
            <div class="card-body text-center">
                <table class="table table-striped table-hover table-bordered">
                    <thead class="table-primary">
                        <tr>
                            <th>
                                ID
                            </th>
                            <th>
                                From
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
                        @foreach ($notifications as $notification)
                        <tr>
                            <td>
                                1
                            </td>
                            <td>
                                {{$notification->name}}
                            </td>
                            <td>
                                {{$notification->title}}
                            </td>
                            <td>
                                {{\Carbon\Carbon::parse($notification->meet_date)->format('Y-M-d')}}
                            </td>
                            <td>
                                {{date('g:i A' , strtotime($notification->meet_time))}}
                            </td>
                            <td>
                                <x-form action="{{route('Notification.update', $notification->n_id)}}" method="PUT">
                                    <input type="hidden" name="status" value="2">
                                    <button type="submit" class="btn btn-success"> Accept</button>
                                </x-form>
                                <x-form action="{{route('Notification.update', $notification->n_id)}}" method="PUT">
                                    <input type="hidden" name="status" value="3">
                                    <button type="submit" class="btn btn-danger"> Reject</button>
                                </x-form>
                            </td>
                        </tr>
                        @endforeach
                        @if ($notifications->isEmpty())
                            <tr>
                                <td colspan="6" class="text-danger">
                                    No Invitation Yet
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection