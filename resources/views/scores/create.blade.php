<x-layouts.app>
    <h1 class="h3 mb-4">Record score event</h1><div class="card"><div class="card-body">
        <form method="POST" action="{{ route('scores.store') }}">@csrf
            @include('scores._form', ['score' => null])
            <button class="btn btn-primary">Save event</button> <a href="{{ $match ? route('matches.show',$match) : route('scores.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </form>
    </div></div>
</x-layouts.app>
