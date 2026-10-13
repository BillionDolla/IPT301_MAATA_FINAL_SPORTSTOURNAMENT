<x-layouts.app>
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3 mb-4">
        <div>
            <div class="text-uppercase small fw-bold text-success mb-2" style="letter-spacing:.12em">Competition overview · {{ now()->format('l, F j, Y') }}</div>
            <h1 class="page-title mb-1">Good {{ now()->hour < 12 ? 'morning' : (now()->hour < 18 ? 'afternoon' : 'evening') }}, let’s get matchday ready.</h1>
            <p class="page-subtitle mb-0">Your tournament operations at a glance.</p>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('matches.create') }}" class="btn btn-outline-primary"><i class="bi bi-calendar-plus me-1"></i>Schedule match</a>
            <a href="{{ route('tournaments.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>New tournament</a>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-6 col-xl-3"><a href="{{ route('sports-teams.index') }}" class="text-decoration-none text-reset"><div class="card stat-card h-100"><div class="card-body"><div class="d-flex justify-content-between align-items-start mb-3"><span class="stat-label">Registered teams</span><span class="stat-icon"><i class="bi bi-shield-shaded"></i></span></div><div class="stat-value">{{ $totalTeams }}</div><div class="small text-muted mt-2">{{ $activeTeams }} active on the roster</div></div></div></a></div>
        <div class="col-6 col-xl-3"><a href="{{ route('players.index') }}" class="text-decoration-none text-reset"><div class="card stat-card green h-100"><div class="card-body"><div class="d-flex justify-content-between align-items-start mb-3"><span class="stat-label">Players</span><span class="stat-icon"><i class="bi bi-person-badge"></i></span></div><div class="stat-value">{{ $totalPlayers }}</div><div class="small text-muted mt-2">Across all registered teams</div></div></div></a></div>
        <div class="col-6 col-xl-3"><a href="{{ route('tournaments.index') }}" class="text-decoration-none text-reset"><div class="card stat-card warning h-100"><div class="card-body"><div class="d-flex justify-content-between align-items-start mb-3"><span class="stat-label">Tournaments</span><span class="stat-icon"><i class="bi bi-trophy"></i></span></div><div class="stat-value">{{ $totalTournaments }}</div><div class="small text-muted mt-2">{{ $ongoingTournaments }} live · {{ $completedTournaments }} completed</div></div></div></a></div>
        <div class="col-6 col-xl-3"><a href="{{ route('scores.index') }}" class="text-decoration-none text-reset"><div class="card stat-card info h-100"><div class="card-body"><div class="d-flex justify-content-between align-items-start mb-3"><span class="stat-label">Goals recorded</span><span class="stat-icon"><i class="bi bi-bullseye"></i></span></div><div class="stat-value">{{ $totalGoals }}</div><div class="small text-muted mt-2">{{ $totalScores }} match events logged</div></div></div></a></div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-xl-7">
            <section class="card h-100">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <div><h2 class="h5 fw-bold mb-1">Upcoming fixtures</h2><div class="small text-muted">Next scheduled matches</div></div>
                    <a href="{{ route('matches.index',['status'=>'scheduled']) }}" class="btn btn-sm btn-outline-secondary">All fixtures <i class="bi bi-arrow-right ms-1"></i></a>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead><tr><th>Kick-off</th><th>Fixture</th><th>Competition</th><th></th></tr></thead>
                        <tbody>
                            @forelse($upcomingMatches as $match)
                                <tr>
                                    <td class="text-nowrap"><strong>{{ $match->match_datetime->format('M j') }}</strong><div class="small text-muted">{{ $match->match_datetime->format('g:i A') }}</div></td>
                                    <td><div class="fw-semibold">{{ $match->homeTeam->name }}</div><div class="small text-muted">vs {{ $match->awayTeam->name }}</div></td>
                                    <td>{{ $match->tournament->name }}</td>
                                    <td class="text-end"><a href="{{ route('matches.show',$match) }}" class="btn btn-sm btn-light" aria-label="View fixture"><i class="bi bi-arrow-up-right"></i></a></td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="text-center py-5"><div class="text-muted mb-3"><i class="bi bi-calendar2-check fs-2"></i></div><div class="fw-semibold">No upcoming fixtures</div><div class="small text-muted mb-3">Schedule a match to get the competition on the calendar.</div><a href="{{ route('matches.create') }}" class="btn btn-sm btn-primary">Schedule a match</a></td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
        <div class="col-xl-5">
            <section class="card h-100">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <div><h2 class="h5 fw-bold mb-1">Latest results</h2><div class="small text-muted">Recent completed and live matches</div></div>
                    <a href="{{ route('matches.index') }}" class="small text-success text-decoration-none fw-semibold">Match centre <i class="bi bi-arrow-right"></i></a>
                </div>
                <div class="card-body p-0">
                    @forelse($recentResults as $match)
                        <a href="{{ route('matches.show',$match) }}" class="d-flex justify-content-between align-items-center gap-3 px-3 py-3 border-bottom text-decoration-none text-reset">
                            <div class="min-w-0"><div class="small text-muted text-truncate">{{ $match->tournament->name }} · {{ $match->match_datetime->format('M j') }}</div><div class="fw-semibold mt-1">{{ $match->homeTeam->name }}</div><div class="fw-semibold">{{ $match->awayTeam->name }}</div></div>
                            <div class="text-end flex-shrink-0"><div class="fw-bold fs-5">{{ $match->home_score }} <span class="text-muted">:</span> {{ $match->away_score }}</div><span class="badge {{ $match->status === 'in_progress' ? 'text-bg-danger' : 'text-bg-light' }}">{{ $match->status === 'in_progress' ? 'LIVE' : 'FT' }}</span></div>
                        </a>
                    @empty
                        <div class="text-center text-muted py-5"><i class="bi bi-flag fs-2 d-block mb-2"></i>Results will appear here after kick-off.</div>
                    @endforelse
                </div>
                <div class="card-footer bg-white border-0 p-3">
                    <div class="d-flex justify-content-between small py-1"><span class="text-muted"><i class="bi bi-calendar-event me-2"></i>Scheduled</span><strong>{{ $scheduledMatches }}</strong></div>
                    <div class="d-flex justify-content-between small py-1"><span class="text-muted"><i class="bi bi-broadcast me-2"></i>In progress</span><strong>{{ $ongoingMatches }}</strong></div>
                    <div class="d-flex justify-content-between small py-1"><span class="text-muted"><i class="bi bi-check-circle me-2"></i>Completed</span><strong>{{ $completedMatches }}</strong></div>
                </div>
            </section>
        </div>
    </div>

    <div class="card border-0" style="background:linear-gradient(105deg,#163d2b 0%,#1e6241 70%,#268153 100%);color:white">
        <div class="card-body p-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div><div class="text-uppercase small fw-bold mb-2" style="color:#d8f36a;letter-spacing:.12em">Keep the competition moving</div><h2 class="h4 fw-bold mb-1">Everything ready for matchday?</h2><p class="mb-0" style="color:#c4d6ca">Update team rosters, publish your tournament, and keep every score in sync.</p></div>
            <div class="d-flex flex-wrap gap-2"><a href="{{ route('sports-teams.create') }}" class="btn btn-light"><i class="bi bi-shield-plus me-1"></i>Add team</a><a href="{{ route('players.create') }}" class="btn btn-outline-light"><i class="bi bi-person-plus me-1"></i>Register player</a></div>
        </div>
    </div>
</x-layouts.app>
