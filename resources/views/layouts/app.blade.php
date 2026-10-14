<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - @yield('title', 'Dashboard')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .navbar-brand { font-weight: 700; }
        .sidebar { background: #212529; min-height: 100vh; }
        .sidebar .nav-link { color: #adb5bd; padding: 0.75rem 1rem; }
        .sidebar .nav-link:hover { background: #343a40; color: #fff; }
        .sidebar .nav-link.active { background: #0d6efd; color: #fff; }
        .card { border: none; box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075); }
        .table th { background-color: #f1f3f5; border-bottom: 2px solid #dee2e6; }
        .badge { font-size: 0.75rem; }
        .stat-card { border-left: 4px solid #0d6efd; }
        .stat-card.green { border-left-color: #198754; }
        .stat-card.red { border-left-color: #dc3545; }
        .stat-card.warning { border-left-color: #ffc107; }
        .stat-card.info { border-left-color: #0dcaf0; }
        .flash-success { animation: slideIn 0.4s ease; }
        @keyframes slideIn { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
        .match-card { transition: transform 0.2s; }
        .match-card:hover { transform: translateY(-2px); }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar d-none d-md-block" style="width: 250px;">
            <div class="p-3">
                <h5 class="text-white mb-0"><i class="bi bi-trophy-fill me-2"></i>Tournament Hub</h5>
            </div>
            <hr class="text-secondary">
            <nav class="nav flex-column">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="bi bi-speedometer2 me-2"></i>Dashboard
                </a>
                <a class="nav-link" href="{{ route('tournaments.index') }}">
                    <i class="bi bi-trophy me-2"></i>Tournaments
                </a>
                <a class="nav-link" href="{{ route('sports-teams.index') }}">
                    <i class="bi bi-people-fill me-2"></i>Teams
                </a>
                <a class="nav-link" href="{{ route('players.index') }}">
                    <i class="bi bi-person-fill me-2"></i>Players
                </a>
                <a class="nav-link" href="{{ route('matches.index') }}">
                    <i class="bi bi-calendar-event me-2"></i>Matches
                </a>
                <a class="nav-link" href="{{ route('scores.index') }}">
                    <i class="bi bi-bar-chart me-2"></i>Scores
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-grow-1">
            <!-- Top Navigation -->
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-2">
                <div class="container-fluid">
                    <button class="navbar-brand d-md-none">
                        <i class="bi bi-trophy-fill"></i> Tournament Hub
                    </button>
                    <div class="d-flex align-items-center ms-auto">
                        @auth
                            <div class="dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-person-circle me-1"></i>
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item">
                                                <i class="bi bi-box-arrow-right me-2"></i>Logout
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @else
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        @endauth
                    </div>
                </div>
            </nav>

            <!-- Flash Messages -->
            <div class="container-fluid py-3">
                @if(session('success'))
                    <div class="alert alert-success alert-success flash-success">
                        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger flash-success">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                    </div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger flash-success">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <strong>Please fix the following errors:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <!-- Page Content -->
            <main class="container-fluid px-4 pb-5">
                @yield('content')
            </main>

            <footer class="bg-dark text-light text-center py-3 mt-auto">
                <small>&copy; {{ date('Y') }} Basketball Tournament Management System</small>
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>