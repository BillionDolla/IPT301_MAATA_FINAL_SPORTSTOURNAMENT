<x-layouts.app>
    <h1 class="h3 mb-4">Schedule match</h1><div class="card"><div class="card-body">
        <form method="POST" action="{{ route('matches.store') }}">@csrf
            @include('matches._form', ['match' => null])
            <button class="btn btn-primary">Schedule match</button> <a href="{{ route('matches.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </form>
    </div></div>
</x-layouts.app>
