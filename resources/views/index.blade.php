@extends('masterLayout.layout')

<style>
    td {
        height: 100px;
        transition: all 0.2s ease;
    }

    td:hover {
        background: rgba(233, 233, 233, 0.555);
    }
</style>

@section('content')
    <input type="hidden" value="" id="id">
    <div class="container-fluid">
        <div class="mt-4 mb-5"
            style="--bs-breadcrumb-divider: url('data:image/svg+xml,%3Csvgxmlns=\'http://www.w3.org/2000/svg\'width=\'8\'height=\'8\'%3E%3Cpathd=\'M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z\'fill=\'%236c757d\'/%3E%3C/svg%3E');"
            aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Home</li>
            </ol>
        </div>
      
        <div class="card border-0 shadow">
            <div class="card-header">
                <div class="card-title p-2 m-0">Upcoming Meetings</div>
            </div>
            <div class="card-body text-center">
                <div class="container">
                    <div class="d-flex justify-content-between my-2">
                        <div class="btn-group">
                            <a href="?ym={{ $prev }}" class="me-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
                                    class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1" />
                                </svg>
                            </a>
                            <button class="btn btn-primary rounded-3 me-2">{{ $htmlTitleMonth }}</button>
                            <a href="?ym={{ $next }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
                                    class="bi bi-arrow-right-square-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M0 14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2zm4.5-6.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5a.5.5 0 0 1 0-1" />
                                </svg>
                            </a>
                        </div>
                        <button class="btn btn-primary end">{{ $htmlTitle }}</button>
                    </div>
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr style="text-align:right;">
                                <th scope="col"><strong>Sun</strong></th>
                                <th scope="col"><strong>Mon</strong></th>
                                <th scope="col"><strong>Tue</strong></th>
                                <th scope="col"><strong>Wed</strong></th>
                                <th scope="col"><strong>Thu</strong></th>
                                <th scope="col"><strong>Fri</strong></th>
                                <th scope="col"><strong>Sat</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($weeks as $week)
                                {!! $week !!}
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row text-center alert alert-primary">
                        <h4>Calendar</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection