<x-layouts.app>
    <h1 class="h3 mb-4">Edit score event</h1><div class="card"><div class="card-body">
        <form method="POST" action="{{ route('scores.update',$score) }}">@csrf @method('PUT')
            @include('scores._form', ['score' => $score])
            <button class="btn btn-primary">Save changes</button> <a href="{{ route('matches.show',$score->match) }}" class="btn btn-outline-secondary">Cancel</a>
        </form>
    </div></div>
</x-layouts.app>
