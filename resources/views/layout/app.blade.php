<!doctype html>
<html lang="en" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.104.2">
    <title>Smart-todo</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/sticky-footer-navbar/">

    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <!-- Favicons -->
    <meta name="theme-color" content="#712cf9">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body class="d-flex flex-column h-100">

<header>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid container">
            <a class="navbar-brand" href="#">Smart Todo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    @guest()
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('home') }}">Home</a>
                    </li>
                    @endguest
                    @auth()
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('tasks') }}">Tasks</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('users') }}">Users</a>
                    </li>
                    @if(auth()->user()->role_id == 1)
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('roles') }}">Users Roles</a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link active" href="{{ route('audit') }}">System Logs</a>
                     </li>
                     @endif

                    @endauth()
                </ul>
                <ul class="navbar-nav mr-auto mb-2 mb-md-0">
                    @guest()
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('register') }}">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('login') }}">Login</a>
                        </li>
                    @endguest
                    @auth()
                        <li class="nav-item dropdown">
                                <a class="nav-link position-relative" data-bs-toggle="dropdown">
                                    🔔
                                    @if(auth()->user()->unreadNotifications->count() > 0)
                                        <span class="badge bg-danger rounded-circle"
                                              style="position: absolute; top: 0; right: 0;">
                            {{ auth()->user()->unreadNotifications->count() }}
                        </span>
                                    @endif
                                </a>

                                <ul class="dropdown-menu dropdown-menu-end" style="width: 300px;">
                                    <li class="dropdown-header fw-bold">Notifications</li>

                                    @forelse(auth()->user()->unreadNotifications as $notification)
                                        <li>
                                            <a href="{{ route('tasks', $notification->data['task_id']) }}"
                                               class="dropdown-item">
                                                <strong>{{ $notification->data['title'] }}</strong><br>
                                                <small>{{ $notification->data['message'] }}</small>
                                            </a>
                                        </li>
                                    @empty
                                        <li class="dropdown-item text-muted">No new notifications</li>
                                    @endforelse

                                    @if(auth()->user()->unreadNotifications->count() > 0)
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <a href="{{ url('notifications/read-all') }}" class="dropdown-item text-center text-primary">
                                                Mark all as read
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        <li class="nav-item">
                            <a class="nav-link active" >{{ auth()->user()->name }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ url('logout') }}">Logout</a>
                        </li>

                    @endauth()
                </ul>

            </div>
        </div>
    </nav>
</header>

<!-- Begin page content -->
<main class="flex-shrink-0">
    @yield('content')
</main>

<footer class="footer mt-auto py-3 bg-light">
    <div class="container">
        <span class="text-muted">@php echo date('Y').' Smart-ToDo. All rights reserved.' @endphp</span>
    </div>
</footer>

<script src="{{ asset('js/bootstrap.bundle.min.js') }}" ></script>
</body>
</html>
