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
                <li class="breadcrumb-item active" aria-current="page">View Meeting Details</li>
            </ol>
        </div>
        <div class="card border-0 shadow">
            <div class="card-header">
                <div class="card-title p-2 m-0">View Meeting Detail</div>
            </div>
            <div class="card-body text-center">
                @php
                    $count = 1;
                @endphp
                <div class="container p-5  alert alert-primary">
                    <div class="row w-50">
                        <div class="col text-end">
                            <h6 class="fw-bold">
                                Meeting Title :
                            </h6>
                        </div>
                        <div class="col text-start">
                            <p>{{ $meeting->title }}</p>
                        </div>
                    </div>
                    <div class="row w-50">
                        <div class="col text-end">
                            <h6 class="fw-bold">
                                Meeting Date :
                            </h6>
                        </div>
                        <div class="col text-start">
                            <p>
                                {{ \Carbon\Carbon::parse($meeting->meet_date)->format('Y-M-d') }}
                            </p>

                        </div>
                    </div>
                    <div class="row w-50">
                        <div class="col text-end">
                            <h6 class="fw-bold">
                                Meeting Time :
                            </h6>
                        </div>
                        <div class="col text-start">
                            <p>{{ date('g:i A', strtotime($meeting->meet_time)) }}</p>
                        </div>
                    </div>
                    <div class="row w-50">
                        <div class="col text-end">
                            <h6 class="fw-bold">
                                Meeting Duration :
                            </h6>
                        </div>
                        <div class="col text-start">
                            <p>{{ $meeting->meet_duration }}</p>
                        </div>
                    </div>
                    <div class="row w-50">
                        <div class="col text-end">
                            <h6 class="fw-bold">
                                Meeting Location :
                            </h6>
                        </div>
                        <div class="col text-start">
                            <p>{{ $meeting->meet_location }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection