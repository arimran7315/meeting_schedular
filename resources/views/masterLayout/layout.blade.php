<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<!-- headerlinks -->

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Efficient Meeting Scheduler Application Development Using PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    <script src="https://kit.fontawesome.com/92f6898643.js" crossorigin="anonymous"></script>
    <link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.0.2/b-3.0.1/datatables.min.css" rel="stylesheet">
</head>
<style>
    td {
        height: 100px;
        transition: all 0.2s ease;
    }

    td:hover {
        background: rgba(233, 233, 233, 0.555);
    }
</style>

<body>
    <div class="wrapper">
        <!-- sidebar -->
        <div id="sidebar">
            <div class="sidebar h-100">
                <div class="sidebar-logo">
                    <a href="{{ route('index') }}">Meeting Schedular</a>
                </div>
                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Dashboard
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('Notification.edit', Auth::user()->id) }}" class="sidebar-link"><i
                                class="fa-solid fa-envelope pe-2"></i>Meeting
                            Invitations
                            <span class="badge rounded-circle text-bg-primary" id="noti"></span></a>
                    </li>
                    <input type="hidden" id="user_id" value="{{ Auth::user()->id }}">
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#pages"
                            data-bs-toggle="collapse" arua-expended="false">Meeting Options</a>
                        <ul id="pages" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="{{ route('meeting.create') }}" class="sidebar-link"><i
                                        class="fa-solid fa-clipboard-user pe-2"></i>Schedule Meeting</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('meeting.index') }}" class="sidebar-link"><i
                                        class="fa-solid fa-gear pe-2"></i>Manage Meeting</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main">
            <!-- header -->
            <nav class="navbar navbar-expand px-3 border-bottom">
                <button class="btn" id="sidebar-toggle" type="button">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse navbar">
                    <ul class="navbar-nav">
                        <li class="nav-item align-self-center flex-wrap px-4">
                            <p class="marquee">
                                <span>
                                    <strong>{{ Auth::user()->name }}</strong> &nbsp;&nbsp;&nbsp;
                                </span>
                            </p>
                        </li>
                        <li class="nav-item dropdown">
                            @if (Auth::user()->image =="")
                            <a href="javascript:void(0)" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                                <img src="{{ asset('assets/images/user/Profile.jpg') }}"
                                class="avatar img-fluid rounded-circle" alt="" />
                            </a>
                            @else
                            <a href="javascript:void(0)" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                                <img src="{{asset('/storage/'.Auth::user()->image)}}" class="avatar img-fluid rounded-circle" alt="" />
                            </a>
                            @endif
                            <div class="dropdown-menu dropdown-menu-end">
                                <ul>
                                    <li>
                                        <a href="{{route('profile')}}" class="dropdown-item">Profile</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}" class="dropdown-item border-top">Logout</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            {{-- main Body --}}
            <main class="content px-3 py-2">
                @hasSection('content')
                    @yield('content')
                @else
                    Main Content
                @endif
            </main>
            <a href="#" class="theme-toggle">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-brightness-high-fill" viewBox="0 0 16 16">
                    <path
                        d="M12 8a4 4 0 1 1-8 0 4 4 0 0 1 8 0M8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0m0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13m8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5M3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8m10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0m-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0m9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707M4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708"
                        fill="black" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-moon-stars-fill" viewBox="0 0 16 16">
                    <path
                        d="M6 .278a.77.77 0 0 1 .08.858 7.2 7.2 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277q.792-.001 1.533-.16a.79.79 0 0 1 .81.316.73.73 0 0 1-.031.893A8.35 8.35 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.75.75 0 0 1 6 .278" />
                    <path
                        d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.73 1.73 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.73 1.73 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.73 1.73 0 0 0 1.097-1.097zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.16 1.16 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.16 1.16 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732z" />
                </svg>
            </a>
            <!-- footer -->
            <footer class="footer border-top">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start p-3">
                            <p class="mb-0">
                                <a href="" class="text-muted">
                                    <strong>Admin Panel Layout</strong>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- footerlinks -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
            </script>
            <script src="{{ asset('assets/js/script.js') }}"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="{{ asset('assets/js/noti.js') }}"></script>

            <script>
                function notification(){
                    const id = document.querySelector('#user_id').value;
                   const notification = document.querySelector('#noti');
                    fetch(`api/readNotification/${id}`, {
                        method: 'GET',
                        headers: {
                            'content-type': 'application/json',
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        notification.innerHTML = data.data
                    });
                }
                notification();
            </script>
        </div>
    </div>
</body>

</html>
