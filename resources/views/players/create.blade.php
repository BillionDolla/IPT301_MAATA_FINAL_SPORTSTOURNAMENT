<x-layouts.app>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Add Player</h1><a href="{{ route('players.index') }}" class="btn btn-outline-secondary">Back to players</a>
    </div>
    <div class="card"><div class="card-body">
        <form method="POST" action="{{ route('players.store') }}">@csrf
            @include('players._form', ['player' => null])
            <button class="btn btn-primary">Save player</button>
            <a href="{{ route('players.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </form>
    </div></div>
</x-layouts.app>
