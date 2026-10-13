<x-layouts.app>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Edit {{ $player->full_name }}</h1><a href="{{ route('players.show', $player) }}" class="btn btn-outline-secondary">Back</a>
    </div>
    <div class="card"><div class="card-body">
        <form method="POST" action="{{ route('players.update', $player) }}">@csrf @method('PUT')
            @include('players._form', ['player' => $player])
            <button class="btn btn-primary">Update player</button>
            <a href="{{ route('players.show', $player) }}" class="btn btn-outline-secondary">Cancel</a>
        </form>
    </div></div>
</x-layouts.app>
