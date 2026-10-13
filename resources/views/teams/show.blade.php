<x-layouts.app>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0"><i class="bi bi-eye me-2"></i>{{ $team->name }}</h2>
        <div class="d-flex gap-2">
            <a href="{{ route('sports-teams.edit', $team) }}" class="btn btn-primary">
                <i class="bi bi-pencil me-1"></i>Edit
            </a>
            <a href="{{ route('sports-teams.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i>Back
            </a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>Team Information</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <p class="text-muted small mb-1">Location</p>
                            <p class="mb-0">{{ $team->city ?? 'N/A' }}, Bohol, Central Visayas, {{ $team->country ?? 'Philippines' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted small mb-1">Coach</p>
                            <p class="mb-0">{{ $team->coach ?? 'TBD' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted small mb-1">Stadium</p>
                            <p class="mb-0">{{ $team->stadium ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted small mb-1">Founded Year</p>
                            <p class="mb-0">{{ $team->founded_year ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted small mb-1">Team Color</p>
                            <p class="mb-0">{{ $team->team_color ?? 'N/A' }}</p>
                        </div>
                    </div>
                    @if($team->description)
                        <hr>
                        <p class="text-muted small mb-1">Description</p>
                        <p class="mb-0">{{ $team->description }}</p>
                    @endif
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="bi bi-people-fill me-2"></i>Players ({{ $team->players->count() }})</h5>
                    <a href="{{ route('players.create') }}" class="btn btn-sm btn-primary">
                        <i class="bi bi-plus me-1"></i>Add Player
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Player</th>
                                    <th>Position</th>
                                    <th>Jersey</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($team->players->take(10) as $player)
                                    <tr>
                                        <td>
                                            <strong>{{ $player->full_name }}</strong>
                                            @if($player->is_captain)
                                                <span class="badge bg-warning ms-1">C</span>
                                            @endif
                                        </td>
                                        <td><span class="badge bg-light text-dark">{{ $player->position ?? 'N/A' }}</span></td>
                                        <td>{{ $player->jersey_number ?? 'N/A' }}</td>
                                        <td><span class="badge bg-{{ $player->player_status === 'active' ? 'success' : 'secondary' }}">{{ $player->player_status }}</span></td>
                                        <td class="text-end">
                                            <a href="{{ route('players.show', $player) }}" class="btn btn-sm btn-outline-primary">View</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5" class="text-center text-muted py-4">No players yet.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-bar-chart me-2"></i>Team Stats</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between py-2 border-bottom">
                        <span>Total Players</span>
                        <strong>{{ $team->players->count() }}</strong>
                    </div>
                    <div class="d-flex justify-content-between py-2 border-bottom">
                        <span>Active Players</span>
                        <strong>{{ $team->players->where('player_status', 'active')->count() }}</strong>
                    </div>
                    <div class="d-flex justify-content-between py-2 border-bottom">
                        <span>Total Matches</span>
                        <strong>{{ $team->homeMatches->count() + $team->awayMatches->count() }}</strong>
                    </div>
                    <div class="d-flex justify-content-between py-2 border-bottom">
                        <span>Goals Scored</span>
                        <strong class="text-success">{{ $team->totalGoalsScored() }}</strong>
                    </div>
                    <div class="d-flex justify-content-between py-2">
                        <span>Goals Conceded</span>
                        <strong class="text-danger">{{ $team->totalGoalsConceded() }}</strong>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-calendar-event me-2"></i>Recent Matches</h5>
                </div>
                <div class="card-body p-0">
                    @php
                        $recentMatches = $team->homeMatches->merge($team->awayMatches)->sortByDesc('match_datetime')->take(5);
                    @endphp
                    @forelse($recentMatches as $match)
                        <div class="p-3 border-bottom">
                            <div class="small text-muted">{{ $match->match_datetime->format('M d, Y H:i') }}</div>
                            <div class="mb-1">
                                <strong>{{ $match->homeTeam->name ?? 'TBD' }}</strong> vs
                                <strong>{{ $match->awayTeam->name ?? 'TBD' }}</strong>
                            </div>
                            <span class="badge bg-{{ $match->status === 'completed' ? 'success' : ($match->status === 'in_progress' ? 'warning' : 'secondary') }}">
                                {{ $match->status === 'completed' ? $match->home_score . ' - ' . $match->away_score : $match->status }}
                            </span>
                        </div>
                    @empty
                        <p class="text-muted text-center py-4">No matches yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>