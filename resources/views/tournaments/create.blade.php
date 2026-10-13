<x-layouts.app>
    <h1 class="h3 mb-4">Create tournament</h1><div class="card"><div class="card-body">
        <form method="POST" action="{{ route('tournaments.store') }}">@csrf
            @include('tournaments._form', ['tournament' => null])
            <button class="btn btn-primary">Create tournament</button> <a href="{{ route('tournaments.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </form>
    </div></div>
</x-layouts.app>
