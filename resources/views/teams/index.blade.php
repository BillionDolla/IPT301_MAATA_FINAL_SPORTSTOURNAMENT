<x-layouts.app>
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3 mb-4">
        <div><div class="text-uppercase small fw-bold text-success mb-2" style="letter-spacing:.1em">Competition</div><h1 class="page-title mb-1">Teams</h1><p class="page-subtitle mb-0">Manage clubs, home grounds, and team rosters.</p></div>
        <a href="{{ route('sports-teams.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i>Register team
        </a>
    </div>

    <!-- Filters -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('sports-teams.index') }}" class="row g-3">
                <div class="col-md-6">
                    <div class="input-group"><span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span><input type="text" name="search" class="form-control border-start-0" placeholder="Search teams, cities, coaches..."
                           value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select">
                        <option value="">All Status</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-outline-primary w-100"><i class="bi bi-funnel me-1"></i>Filter</button>
                </div>
                <div class="col-md-1">
                    <a href="{{ route('sports-teams.index') }}" class="btn btn-light w-100" title="Clear filters"><i class="bi bi-arrow-counterclockwise"></i></a>
                </div>
            </form>
        </div>
    </div>

    <!-- Teams Grid -->
    <div class="row g-4">
        @forelse($teams as $team)
            <div class="col-xl-4 col-lg-6">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="mb-0">{{ $team->name }}</h5>
                            <span class="badge {{ $team->is_active ? 'bg-success' : 'bg-secondary' }}">
                                {{ $team->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                        <p class="text-muted small mb-2">
                            <i class="bi bi-geo-alt me-1"></i>{{ $team->city ?? 'N/A' }}, Bohol, Central Visayas, {{ $team->country ?? 'Philippines' }}
                        </p>
                        <p class="text-muted small mb-2">
                            <i class="bi bi-person me-1"></i>Coach: {{ $team->coach ?? 'TBD' }}
                        </p>
                        <p class="text-muted small mb-2">
                            <i class="bi bi-building me-1"></i>{{ $team->stadium ?? 'No stadium' }}
                        </p>
                        <div class="row text-center mt-3">
                            <div class="col-4">
                                <h6 class="mb-0 text-success">{{ $team->players_count }}</h6>
                                <small class="text-muted">Players</small>
                            </div>
                            <div class="col-4">
                                <h6 class="mb-0 text-success">{{ $team->home_matches_count + $team->away_matches_count }}</h6>
                                <small class="text-muted">Matches</small>
                            </div>
                            <div class="col-4">
                                <h6 class="mb-0 text-warning">{{ $team->founded_year ?? 'N/A' }}</h6>
                                <small class="text-muted">Founded</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white d-flex gap-2">
                        <a href="{{ route('sports-teams.show', $team) }}" class="btn btn-sm btn-outline-primary flex-fill">
                            <i class="bi bi-eye me-1"></i>View
                        </a>
                        <a href="{{ route('sports-teams.edit', $team) }}" class="btn btn-sm btn-outline-secondary flex-fill">
                            <i class="bi bi-pencil me-1"></i>Edit
                        </a>
                        <form method="POST" action="{{ route('sports-teams.destroy', $team) }}" class="d-inline" onsubmit="return confirm('Delete this team?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">No teams found. <a href="{{ route('sports-teams.create') }}">Create the first team</a>.</div>
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $teams->links() }}
    </div>
</x-layouts.app>