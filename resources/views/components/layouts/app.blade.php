<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Sports Tournament Management System') }} | @yield('title', 'Sports Tournament Management')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root { --ink: #17251f; --muted: #718078; --line: #e7ede9; --field: #f7f9f8; --green: #157347; --lime: #d8f36a; }
        body { background: #f4f7f5; color: var(--ink); font-family: Inter, ui-sans-serif, system-ui, -apple-system, "Segoe UI", sans-serif; }
        .topbar { min-height: 68px; background: #fff; border-bottom: 1px solid var(--line); }
        .navbar-brand { color: var(--ink) !important; font-size: 1.05rem; font-weight: 750; letter-spacing: -.035em; }
        .brand-mark { display: inline-grid; place-items: center; width: 36px; height: 36px; border-radius: 12px; color: #163d2a; background: var(--lime); }
        .topbar .nav-link { color: #59685f; font-size: .88rem; font-weight: 600; padding: .65rem .8rem !important; }
        .topbar .nav-link:hover { color: var(--green); }
        .sidebar { background: #14221b; min-height: calc(100vh - 68px); width: 244px; flex: 0 0 244px; padding: 22px 14px; }
        .sidebar-caption { padding: .65rem .8rem .45rem; color: #82948a; font-size: .66rem; font-weight: 750; letter-spacing: .12em; text-transform: uppercase; }
        .sidebar .nav-link { display: flex; align-items: center; border-radius: 10px; color: #b5c4bb; font-size: .88rem; font-weight: 600; margin: 2px 0; padding: .73rem .8rem; }
        .sidebar .nav-link i { width: 23px; font-size: 1rem; }
        .sidebar .nav-link:hover { background: #20372a; color: #fff; }
        .sidebar .nav-link.active { background: #d8f36a; color: #193324; }
        .sidebar-note { background: #1d3025; border: 1px solid #2a4132; border-radius: 12px; color: #bfcec4; font-size: .76rem; line-height: 1.5; margin: 28px 4px 0; padding: 14px; }
        .sidebar-note strong { color: #e6f4d0; display: block; font-size: .82rem; margin-bottom: 4px; }
        .app-content { max-width: 1600px; }
        .card { border: 1px solid var(--line); border-radius: 15px; box-shadow: 0 3px 12px rgba(26, 47, 35, .035); }
        .card-header { border-color: var(--line) !important; border-radius: 15px 15px 0 0 !important; padding: 17px 20px; }
        .card-body { padding: 20px; }
        .table { --bs-table-bg: transparent; }
        .table th { background: #f7f9f8; border-bottom: 1px solid var(--line); color: #728078; font-size: .7rem; font-weight: 750; letter-spacing: .07em; padding: 13px 16px; text-transform: uppercase; }
        .table td { border-color: #edf1ee; color: #38473f; font-size: .86rem; padding: 14px 16px; vertical-align: middle; }
        .table-hover tbody tr:hover { --bs-table-accent-bg: #f8fbf8; }
        .form-control, .form-select { background-color: #fff; border-color: #dfe7e2; border-radius: 9px; min-height: 42px; }
        .form-control:focus, .form-select:focus { border-color: #75a98b; box-shadow: 0 0 0 .2rem rgba(21, 115, 71, .12); }
        .form-label { color: #44534a; font-size: .8rem; font-weight: 650; }
        .btn { border-radius: 9px; font-weight: 650; }
        .btn-primary { --bs-btn-bg: #176b45; --bs-btn-border-color: #176b45; --bs-btn-hover-bg: #105637; --bs-btn-hover-border-color: #105637; --bs-btn-color: #fff; }
        .btn-outline-primary { --bs-btn-color: #176b45; --bs-btn-border-color: #a5c3b1; --bs-btn-hover-bg: #176b45; --bs-btn-hover-border-color: #176b45; }
        .badge { border-radius: 100px; font-weight: 650; padding: .43em .72em; }
        .text-muted { color: var(--muted) !important; }
        .page-title { font-size: 1.65rem; font-weight: 760; letter-spacing: -.045em; }
        .page-subtitle { color: var(--muted); font-size: .9rem; margin-top: 5px; }
        .stat-card { border-left: 0; overflow: hidden; position: relative; }
        .stat-card:before { background: var(--stat-color, #176b45); content: ""; inset: 0 auto 0 0; position: absolute; width: 4px; }
        .stat-card.green { --stat-color: #3c9c68; }
        .stat-card.warning { --stat-color: #d7a43d; }
        .stat-card.info { --stat-color: #589a9a; }
        .stat-icon { align-items: center; background: var(--stat-bg, #e7f3ec); border-radius: 12px; color: var(--stat-color, #176b45); display: flex; font-size: 1.2rem; height: 42px; justify-content: center; width: 42px; }
        .stat-value { font-size: 1.9rem; font-weight: 760; letter-spacing: -.06em; line-height: 1.15; }
        .stat-label { color: var(--muted); font-size: .77rem; font-weight: 600; }
        .alert { border: 0; border-radius: 11px; }
        .pagination { gap: 4px; }
        .page-link { border-color: var(--line); border-radius: 8px !important; color: #176b45; }
        footer { border-top: 1px solid var(--line); color: #819087 !important; background: #fff !important; }
        @media (max-width: 767.98px) {
            .sidebar { display: none; }
            .topbar .navbar-collapse { padding-top: 12px; }
            .app-content { padding: 16px !important; }
            .page-title { font-size: 1.4rem; }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-md topbar sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('dashboard') }}"><span class="brand-mark"><i class="bi bi-trophy"></i></span><span>SPORTS <span class="text-success">TOURNAMENT</span></span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavigation" aria-controls="mainNavigation" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNavigation">
                <div class="navbar-nav ms-auto align-items-md-center">
                    <a class="nav-link d-md-none" href="{{ route('dashboard') }}">Dashboard</a>
                    <a class="nav-link d-md-none" href="{{ route('tournaments.index') }}">Tournaments</a>
                    <a class="nav-link d-md-none" href="{{ route('sports-teams.index') }}">Teams</a>
                    <a class="nav-link d-md-none" href="{{ route('players.index') }}">Players</a>
                    <a class="nav-link d-md-none" href="{{ route('matches.index') }}">Matches</a>
                    <a class="nav-link d-md-none" href="{{ route('scores.index') }}">Scores</a>
                    @auth
                        <span class="navbar-text small ms-md-3">{{ Auth::user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}" class="ms-md-3">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-light">Logout</button>
                        </form>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
    <div class="d-flex">
        <aside class="sidebar d-none d-md-block">
            <nav class="nav flex-column py-3">
                <div class="sidebar-caption">Workspace</div>
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
                <div class="sidebar-caption mt-3">Competition</div>
                <a class="nav-link {{ request()->routeIs('tournaments.*') ? 'active' : '' }}" href="{{ route('tournaments.index') }}"><i class="bi bi-trophy me-2"></i>Tournaments</a>
                <a class="nav-link {{ request()->routeIs('sports-teams.*') ? 'active' : '' }}" href="{{ route('sports-teams.index') }}"><i class="bi bi-people-fill me-2"></i>Teams</a>
                <a class="nav-link {{ request()->routeIs('players.*') ? 'active' : '' }}" href="{{ route('players.index') }}"><i class="bi bi-person-fill me-2"></i>Players</a>
                <a class="nav-link {{ request()->routeIs('matches.*') ? 'active' : '' }}" href="{{ route('matches.index') }}"><i class="bi bi-calendar-event me-2"></i>Matches</a>
                <a class="nav-link {{ request()->routeIs('scores.*') ? 'active' : '' }}" href="{{ route('scores.index') }}"><i class="bi bi-bar-chart me-2"></i>Scores</a>
                <div class="sidebar-note"><strong>Competition desk</strong>Keep fixtures, results, rosters, and tournament details in one place.</div>
            </nav>
        </aside>
        <div class="flex-grow-1 min-vh-100 d-flex flex-column">
            <main class="container-fluid app-content p-3 p-lg-4 flex-grow-1">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <strong>Please correct the following:</strong>
                        <ul class="mb-0 mt-2">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                    </div>
                @endif
                {{ $slot }}
            </main>
            <footer class="bg-dark text-light text-center py-3"><small>&copy; {{ date('Y') }} Sports Tournament Management System</small></footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
