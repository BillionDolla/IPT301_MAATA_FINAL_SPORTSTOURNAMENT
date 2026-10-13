<x-layouts.app>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div><h1 class="h3 mb-1">{{ $player->full_name }}</h1><div class="text-muted">{{ $player->team->name }}</div></div>
        <div class="d-flex gap-2"><a href="{{ route('players.edit', $player) }}" class="btn btn-primary">Edit</a><a href="{{ route('players.index') }}" class="btn btn-outline-secondary">Back</a></div>
    </div>
    <div class="row g-3 mb-4">
        <div class="col-md-4"><div class="card h-100"><div class="card-body"><h2 class="h6 text-muted">Position</h2><p class="mb-0">{{ ucfirst($player->position ?? 'Not set') }}</p></div></div></div>
        <div class="col-md-4"><div class="card h-100"><div class="card-body"><h2 class="h6 text-muted">Jersey</h2><p class="mb-0">{{ $player->jersey_number ?? 'Not set' }}</p></div></div></div>
        <div class="col-md-4"><div class="card h-100"><div class="card-body"><h2 class="h6 text-muted">Status</h2><p class="mb-0">{{ ucfirst(str_replace('_', ' ', $player->player_status)) }}</p></div></div></div>
    </div>
    <div class="card"><div class="card-header bg-white"><h2 class="h5 mb-0">Recent score events</h2></div><div class="table-responsive"><table class="table mb-0"><thead><tr><th>Event</th><th>Match</th><th>Tournament</th><th>Minute</th></tr></thead><tbody>
        @forelse($goals as $event)<tr><td><a href="{{ route('scores.show', $event) }}">{{ ucfirst(str_replace('_', ' ', $event->score_type)) }}</a></td><td>{{ $event->match->homeTeam->name }} vs {{ $event->match->awayTeam->name }}</td><td>{{ $event->match->tournament->name }}</td><td>{{ $event->minute ? $event->minute."'" : '—' }}</td></tr>@empty<tr><td colspan="4" class="text-center text-muted py-4">No score events recorded.</td></tr>@endforelse
    </tbody></table></div></div>
</x-layouts.app>
