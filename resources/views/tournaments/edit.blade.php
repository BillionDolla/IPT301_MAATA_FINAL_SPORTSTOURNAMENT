<x-layouts.app>
    <h1 class="h3 mb-4">Edit tournament</h1><div class="card"><div class="card-body">
        <form method="POST" action="{{ route('tournaments.update',$tournament) }}">@csrf @method('PUT')
            @include('tournaments._form', ['tournament' => $tournament])
            <button class="btn btn-primary">Save changes</button> <a href="{{ route('tournaments.show',$tournament) }}" class="btn btn-outline-secondary">Cancel</a>
        </form>
    </div></div>
</x-layouts.app>
