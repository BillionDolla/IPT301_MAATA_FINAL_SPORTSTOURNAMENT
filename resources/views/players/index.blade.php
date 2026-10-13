<x-layouts.app>
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3 mb-4">
        <div><div class="text-uppercase small fw-bold text-success mb-2" style="letter-spacing:.1em">Competition</div><h1 class="page-title mb-1">Players</h1><p class="page-subtitle mb-0">Player registrations, team assignments, and availability.</p></div>
        <a href="{{ route('players.create') }}" class="btn btn-primary">
            <i class="bi bi-person-plus me-1"></i>Register player
        </a>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('players.index') }}" class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Search name or email..."
                           value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="team_id" class="form-select">
                        <option value="">All Teams</option>
                        @foreach($teams as $t)
                            <option value="{{ $t->id }}" {{ request('team_id') == $t->id ? 'selected' : '' }}>
                                {{ $t->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="position" class="form-select">
                        <option value="">All Positions</option>
                        @foreach(['goalkeeper','defender','midfielder','forward','striker','captain','substitute'] as $pos)
                            <option value="{{ $pos }}" {{ request('position') === $pos ? 'selected' : '' }}>
                                {{ ucfirst($pos) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="status" class="form-select">
                        <option value="">All Status</option>
                        @foreach(['active','injured','suspended','retired','loaned_out'] as $st)
                            <option value="{{ $st }}" {{ request('status') === $st ? 'selected' : '' }}>
                                {{ ucfirst($st) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-1"><button class="btn btn-outline-primary w-100"><i class="bi bi-funnel"></i></button></div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Player</th>
                        <th>Team</th>
                        <th>Position</th>
                        <th>Jersey</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($players as $player)
                        <tr>
                            <td>
                                <strong>{{ $player->full_name }}</strong>
                                @if($player->is_captain)
                                    <span class="badge bg-warning ms-1">Captain</span>
                                @endif
                            </td>
                            <td>{{ $player->team->name ?? 'N/A' }}</td>
                            <td><span class="badge text-bg-light">{{ ucfirst($player->position ?? 'Unassigned') }}</span></td>
                            <td>{{ $player->jersey_number ? '#'.$player->jersey_number : '—' }}</td>
                            <td><span class="badge {{ $player->player_status === 'active' ? 'text-bg-success' : 'text-bg-secondary' }}">{{ ucfirst(str_replace('_',' ',$player->player_status)) }}</span></td>
                            <td class="text-end">
                                <a href="{{ route('players.show', $player) }}" class="btn btn-sm btn-outline-primary">View</a>
                                <a href="{{ route('players.edit', $player) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                <form method="POST" action="{{ route('players.destroy', $player) }}" class="d-inline" onsubmit="return confirm('Delete this player?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center text-muted py-4">No players found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-3">{{ $players->links() }}</div>
    </div>
</x-layouts.app>