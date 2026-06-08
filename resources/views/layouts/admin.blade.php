<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Admin Dashboard</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body class="bg-light">
    <div id="app" class="d-flex" style="min-height: 100vh;">

        <nav id="sidebar" class="bg-dark text-white p-3" style="width: 280px;">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <span class="fs-4">Home</span>
            </a>
            <hr>
            <!-- l'uso di "*" permette che la tipologia selezionata rimanga evidenziata anche se si entra nella show -->
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="{{ route('admin.index') }}" class="nav-link text-white {{ request()->routeIs('admin.index') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2 me-2"></i> Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.projects.index') }}" class="nav-link text-white {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
                        <i class="bi bi-journal-code me-2"></i> Progetti
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.types.index') }}" class="nav-link text-white {{ request()->routeIs('admin.types.*') ? 'active' : '' }}">
                        <i class="bi bi-tags me-2"></i> Tipologie
                    </a>
                </li>
            </ul>
            <hr>
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <strong>{{ Auth::user()->name }}</strong>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                    <li>
                        <a class="dropdown-menu-item px-3 text-white text-decoration-none" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Sign out
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </nav>

        <main class="flex-grow-1 p-4">
            <header class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
                <h2>@yield('page-title', 'Dashboard')</h2>
            </header>

            <div class="container-fluid">
                @yield('content')
            </div>
        </main>

    </div>
</body>

</html>