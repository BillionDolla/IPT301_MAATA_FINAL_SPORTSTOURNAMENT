<x-layouts.app>
    <h1 class="h3 mb-4">Edit match</h1><div class="card"><div class="card-body">
        <form method="POST" action="{{ route('matches.update',$match) }}">@csrf @method('PUT')
            @include('matches._form', ['match' => $match])
            <button class="btn btn-primary">Save changes</button> <a href="{{ route('matches.show',$match) }}" class="btn btn-outline-secondary">Cancel</a>
        </form>
    </div></div>
</x-layouts.app>
