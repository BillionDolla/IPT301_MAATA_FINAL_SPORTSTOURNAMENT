import {
    queryParams,
    type RouteQueryOptions,
    type RouteDefinition,
    type RouteFormDefinition,
    applyUrlDefaults,
} from './../../wayfinder';
/**
 * @see \App\Http\Controllers\TournamentController::index
 * @see app/Http/Controllers/TournamentController.php:21
 * @route '/tournaments'
 */
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
});

index.definition = {
    methods: ['get', 'head'],
    url: '/tournaments',
} satisfies RouteDefinition<['get', 'head']>;

/**
 * @see \App\Http\Controllers\TournamentController::index
 * @see app/Http/Controllers/TournamentController.php:21
 * @route '/tournaments'
 */
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options);
};

/**
 * @see \App\Http\Controllers\TournamentController::index
 * @see app/Http/Controllers/TournamentController.php:21
 * @route '/tournaments'
 */
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
});
/**
 * @see \App\Http\Controllers\TournamentController::index
 * @see app/Http/Controllers/TournamentController.php:21
 * @route '/tournaments'
 */
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
});

/**
 * @see \App\Http\Controllers\TournamentController::index
 * @see app/Http/Controllers/TournamentController.php:21
 * @route '/tournaments'
 */
const indexForm = (
    options?: RouteQueryOptions,
): RouteFormDefinition<'get'> => ({
    action: index.url(options),
    method: 'get',
});

/**
 * @see \App\Http\Controllers\TournamentController::index
 * @see app/Http/Controllers/TournamentController.php:21
 * @route '/tournaments'
 */
indexForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url(options),
    method: 'get',
});
/**
 * @see \App\Http\Controllers\TournamentController::index
 * @see app/Http/Controllers/TournamentController.php:21
 * @route '/tournaments'
 */
indexForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        },
    }),
    method: 'get',
});

index.form = indexForm;
/**
 * @see \App\Http\Controllers\TournamentController::create
 * @see app/Http/Controllers/TournamentController.php:53
 * @route '/tournaments/create'
 */
export const create = (
    options?: RouteQueryOptions,
): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
});

create.definition = {
    methods: ['get', 'head'],
    url: '/tournaments/create',
} satisfies RouteDefinition<['get', 'head']>;

/**
 * @see \App\Http\Controllers\TournamentController::create
 * @see app/Http/Controllers/TournamentController.php:53
 * @route '/tournaments/create'
 */
create.url = (options?: RouteQueryOptions) => {
    return create.definition.url + queryParams(options);
};

/**
 * @see \App\Http\Controllers\TournamentController::create
 * @see app/Http/Controllers/TournamentController.php:53
 * @route '/tournaments/create'
 */
create.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
});
/**
 * @see \App\Http\Controllers\TournamentController::create
 * @see app/Http/Controllers/TournamentController.php:53
 * @route '/tournaments/create'
 */
create.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: create.url(options),
    method: 'head',
});

/**
 * @see \App\Http\Controllers\TournamentController::create
 * @see app/Http/Controllers/TournamentController.php:53
 * @route '/tournaments/create'
 */
const createForm = (
    options?: RouteQueryOptions,
): RouteFormDefinition<'get'> => ({
    action: create.url(options),
    method: 'get',
});

/**
 * @see \App\Http\Controllers\TournamentController::create
 * @see app/Http/Controllers/TournamentController.php:53
 * @route '/tournaments/create'
 */
createForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: create.url(options),
    method: 'get',
});
/**
 * @see \App\Http\Controllers\TournamentController::create
 * @see app/Http/Controllers/TournamentController.php:53
 * @route '/tournaments/create'
 */
createForm.head = (
    options?: RouteQueryOptions,
): RouteFormDefinition<'get'> => ({
    action: create.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        },
    }),
    method: 'get',
});

create.form = createForm;
/**
 * @see \App\Http\Controllers\TournamentController::store
 * @see app/Http/Controllers/TournamentController.php:61
 * @route '/tournaments'
 */
export const store = (
    options?: RouteQueryOptions,
): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
});

store.definition = {
    methods: ['post'],
    url: '/tournaments',
} satisfies RouteDefinition<['post']>;

/**
 * @see \App\Http\Controllers\TournamentController::store
 * @see app/Http/Controllers/TournamentController.php:61
 * @route '/tournaments'
 */
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options);
};

/**
 * @see \App\Http\Controllers\TournamentController::store
 * @see app/Http/Controllers/TournamentController.php:61
 * @route '/tournaments'
 */
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
});

/**
 * @see \App\Http\Controllers\TournamentController::store
 * @see app/Http/Controllers/TournamentController.php:61
 * @route '/tournaments'
 */
const storeForm = (
    options?: RouteQueryOptions,
): RouteFormDefinition<'post'> => ({
    action: store.url(options),
    method: 'post',
});

/**
 * @see \App\Http\Controllers\TournamentController::store
 * @see app/Http/Controllers/TournamentController.php:61
 * @route '/tournaments'
 */
storeForm.post = (
    options?: RouteQueryOptions,
): RouteFormDefinition<'post'> => ({
    action: store.url(options),
    method: 'post',
});

store.form = storeForm;
/**
 * @see \App\Http\Controllers\TournamentController::show
 * @see app/Http/Controllers/TournamentController.php:73
 * @route '/tournaments/{tournament}'
 */
export const show = (
    args:
        | { tournament: number | { id: number } }
        | [tournament: number | { id: number }]
        | number
        | { id: number },
    options?: RouteQueryOptions,
): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
});

show.definition = {
    methods: ['get', 'head'],
    url: '/tournaments/{tournament}',
} satisfies RouteDefinition<['get', 'head']>;

/**
 * @see \App\Http\Controllers\TournamentController::show
 * @see app/Http/Controllers/TournamentController.php:73
 * @route '/tournaments/{tournament}'
 */
show.url = (
    args:
        | { tournament: number | { id: number } }
        | [tournament: number | { id: number }]
        | number
        | { id: number },
    options?: RouteQueryOptions,
) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { tournament: args };
    }

    if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
        args = { tournament: args.id };
    }

    if (Array.isArray(args)) {
        args = {
            tournament: args[0],
        };
    }

    args = applyUrlDefaults(args);

    const parsedArgs = {
        tournament:
            typeof args.tournament === 'object'
                ? args.tournament.id
                : args.tournament,
    };

    return (
        show.definition.url
            .replace('{tournament}', parsedArgs.tournament.toString())
            .replace(/\/+$/, '') + queryParams(options)
    );
};

/**
 * @see \App\Http\Controllers\TournamentController::show
 * @see app/Http/Controllers/TournamentController.php:73
 * @route '/tournaments/{tournament}'
 */
show.get = (
    args:
        | { tournament: number | { id: number } }
        | [tournament: number | { id: number }]
        | number
        | { id: number },
    options?: RouteQueryOptions,
): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
});
/**
 * @see \App\Http\Controllers\TournamentController::show
 * @see app/Http/Controllers/TournamentController.php:73
 * @route '/tournaments/{tournament}'
 */
show.head = (
    args:
        | { tournament: number | { id: number } }
        | [tournament: number | { id: number }]
        | number
        | { id: number },
    options?: RouteQueryOptions,
): RouteDefinition<'head'> => ({
    url: show.url(args, options),
    method: 'head',
});

/**
 * @see \App\Http\Controllers\TournamentController::show
 * @see app/Http/Controllers/TournamentController.php:73
 * @route '/tournaments/{tournament}'
 */
const showForm = (
    args:
        | { tournament: number | { id: number } }
        | [tournament: number | { id: number }]
        | number
        | { id: number },
    options?: RouteQueryOptions,
): RouteFormDefinition<'get'> => ({
    action: show.url(args, options),
    method: 'get',
});

/**
 * @see \App\Http\Controllers\TournamentController::show
 * @see app/Http/Controllers/TournamentController.php:73
 * @route '/tournaments/{tournament}'
 */
showForm.get = (
    args:
        | { tournament: number | { id: number } }
        | [tournament: number | { id: number }]
        | number
        | { id: number },
    options?: RouteQueryOptions,
): RouteFormDefinition<'get'> => ({
    action: show.url(args, options),
    method: 'get',
});
/**
 * @see \App\Http\Controllers\TournamentController::show
 * @see app/Http/Controllers/TournamentController.php:73
 * @route '/tournaments/{tournament}'
 */
showForm.head = (
    args:
        | { tournament: number | { id: number } }
        | [tournament: number | { id: number }]
        | number
        | { id: number },
    options?: RouteQueryOptions,
): RouteFormDefinition<'get'> => ({
    action: show.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        },
    }),
    method: 'get',
});

show.form = showForm;
/**
 * @see \App\Http\Controllers\TournamentController::edit
 * @see app/Http/Controllers/TournamentController.php:103
 * @route '/tournaments/{tournament}/edit'
 */
export const edit = (
    args:
        | { tournament: number | { id: number } }
        | [tournament: number | { id: number }]
        | number
        | { id: number },
    options?: RouteQueryOptions,
): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
});

edit.definition = {
    methods: ['get', 'head'],
    url: '/tournaments/{tournament}/edit',
} satisfies RouteDefinition<['get', 'head']>;

/**
 * @see \App\Http\Controllers\TournamentController::edit
 * @see app/Http/Controllers/TournamentController.php:103
 * @route '/tournaments/{tournament}/edit'
 */
edit.url = (
    args:
        | { tournament: number | { id: number } }
        | [tournament: number | { id: number }]
        | number
        | { id: number },
    options?: RouteQueryOptions,
) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { tournament: args };
    }

    if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
        args = { tournament: args.id };
    }

    if (Array.isArray(args)) {
        args = {
            tournament: args[0],
        };
    }

    args = applyUrlDefaults(args);

    const parsedArgs = {
        tournament:
            typeof args.tournament === 'object'
                ? args.tournament.id
                : args.tournament,
    };

    return (
        edit.definition.url
            .replace('{tournament}', parsedArgs.tournament.toString())
            .replace(/\/+$/, '') + queryParams(options)
    );
};

/**
 * @see \App\Http\Controllers\TournamentController::edit
 * @see app/Http/Controllers/TournamentController.php:103
 * @route '/tournaments/{tournament}/edit'
 */
edit.get = (
    args:
        | { tournament: number | { id: number } }
        | [tournament: number | { id: number }]
        | number
        | { id: number },
    options?: RouteQueryOptions,
): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
});
/**
 * @see \App\Http\Controllers\TournamentController::edit
 * @see app/Http/Controllers/TournamentController.php:103
 * @route '/tournaments/{tournament}/edit'
 */
edit.head = (
    args:
        | { tournament: number | { id: number } }
        | [tournament: number | { id: number }]
        | number
        | { id: number },
    options?: RouteQueryOptions,
): RouteDefinition<'head'> => ({
    url: edit.url(args, options),
    method: 'head',
});

/**
 * @see \App\Http\Controllers\TournamentController::edit
 * @see app/Http/Controllers/TournamentController.php:103
 * @route '/tournaments/{tournament}/edit'
 */
const editForm = (
    args:
        | { tournament: number | { id: number } }
        | [tournament: number | { id: number }]
        | number
        | { id: number },
    options?: RouteQueryOptions,
): RouteFormDefinition<'get'> => ({
    action: edit.url(args, options),
    method: 'get',
});

/**
 * @see \App\Http\Controllers\TournamentController::edit
 * @see app/Http/Controllers/TournamentController.php:103
 * @route '/tournaments/{tournament}/edit'
 */
editForm.get = (
    args:
        | { tournament: number | { id: number } }
        | [tournament: number | { id: number }]
        | number
        | { id: number },
    options?: RouteQueryOptions,
): RouteFormDefinition<'get'> => ({
    action: edit.url(args, options),
    method: 'get',
});
/**
 * @see \App\Http\Controllers\TournamentController::edit
 * @see app/Http/Controllers/TournamentController.php:103
 * @route '/tournaments/{tournament}/edit'
 */
editForm.head = (
    args:
        | { tournament: number | { id: number } }
        | [tournament: number | { id: number }]
        | number
        | { id: number },
    options?: RouteQueryOptions,
): RouteFormDefinition<'get'> => ({
    action: edit.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        },
    }),
    method: 'get',
});

edit.form = editForm;
/**
 * @see \App\Http\Controllers\TournamentController::update
 * @see app/Http/Controllers/TournamentController.php:111
 * @route '/tournaments/{tournament}'
 */
export const update = (
    args:
        | { tournament: number | { id: number } }
        | [tournament: number | { id: number }]
        | number
        | { id: number },
    options?: RouteQueryOptions,
): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
});

update.definition = {
    methods: ['put', 'patch'],
    url: '/tournaments/{tournament}',
} satisfies RouteDefinition<['put', 'patch']>;

/**
 * @see \App\Http\Controllers\TournamentController::update
 * @see app/Http/Controllers/TournamentController.php:111
 * @route '/tournaments/{tournament}'
 */
update.url = (
    args:
        | { tournament: number | { id: number } }
        | [tournament: number | { id: number }]
        | number
        | { id: number },
    options?: RouteQueryOptions,
) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { tournament: args };
    }

    if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
        args = { tournament: args.id };
    }

    if (Array.isArray(args)) {
        args = {
            tournament: args[0],
        };
    }

    args = applyUrlDefaults(args);

    const parsedArgs = {
        tournament:
            typeof args.tournament === 'object'
                ? args.tournament.id
                : args.tournament,
    };

    return (
        update.definition.url
            .replace('{tournament}', parsedArgs.tournament.toString())
            .replace(/\/+$/, '') + queryParams(options)
    );
};

/**
 * @see \App\Http\Controllers\TournamentController::update
 * @see app/Http/Controllers/TournamentController.php:111
 * @route '/tournaments/{tournament}'
 */
update.put = (
    args:
        | { tournament: number | { id: number } }
        | [tournament: number | { id: number }]
        | number
        | { id: number },
    options?: RouteQueryOptions,
): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
});
/**
 * @see \App\Http\Controllers\TournamentController::update
 * @see app/Http/Controllers/TournamentController.php:111
 * @route '/tournaments/{tournament}'
 */
update.patch = (
    args:
        | { tournament: number | { id: number } }
        | [tournament: number | { id: number }]
        | number
        | { id: number },
    options?: RouteQueryOptions,
): RouteDefinition<'patch'> => ({
    url: update.url(args, options),
    method: 'patch',
});

/**
 * @see \App\Http\Controllers\TournamentController::update
 * @see app/Http/Controllers/TournamentController.php:111
 * @route '/tournaments/{tournament}'
 */
const updateForm = (
    args:
        | { tournament: number | { id: number } }
        | [tournament: number | { id: number }]
        | number
        | { id: number },
    options?: RouteQueryOptions,
): RouteFormDefinition<'post'> => ({
    action: update.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'PUT',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        },
    }),
    method: 'post',
});

/**
 * @see \App\Http\Controllers\TournamentController::update
 * @see app/Http/Controllers/TournamentController.php:111
 * @route '/tournaments/{tournament}'
 */
updateForm.put = (
    args:
        | { tournament: number | { id: number } }
        | [tournament: number | { id: number }]
        | number
        | { id: number },
    options?: RouteQueryOptions,
): RouteFormDefinition<'post'> => ({
    action: update.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'PUT',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        },
    }),
    method: 'post',
});
/**
 * @see \App\Http\Controllers\TournamentController::update
 * @see app/Http/Controllers/TournamentController.php:111
 * @route '/tournaments/{tournament}'
 */
updateForm.patch = (
    args:
        | { tournament: number | { id: number } }
        | [tournament: number | { id: number }]
        | number
        | { id: number },
    options?: RouteQueryOptions,
): RouteFormDefinition<'post'> => ({
    action: update.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'PATCH',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        },
    }),
    method: 'post',
});

update.form = updateForm;
/**
 * @see \App\Http\Controllers\TournamentController::destroy
 * @see app/Http/Controllers/TournamentController.php:122
 * @route '/tournaments/{tournament}'
 */
export const destroy = (
    args:
        | { tournament: number | { id: number } }
        | [tournament: number | { id: number }]
        | number
        | { id: number },
    options?: RouteQueryOptions,
): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
});

destroy.definition = {
    methods: ['delete'],
    url: '/tournaments/{tournament}',
} satisfies RouteDefinition<['delete']>;

/**
 * @see \App\Http\Controllers\TournamentController::destroy
 * @see app/Http/Controllers/TournamentController.php:122
 * @route '/tournaments/{tournament}'
 */
destroy.url = (
    args:
        | { tournament: number | { id: number } }
        | [tournament: number | { id: number }]
        | number
        | { id: number },
    options?: RouteQueryOptions,
) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { tournament: args };
    }

    if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
        args = { tournament: args.id };
    }

    if (Array.isArray(args)) {
        args = {
            tournament: args[0],
        };
    }

    args = applyUrlDefaults(args);

    const parsedArgs = {
        tournament:
            typeof args.tournament === 'object'
                ? args.tournament.id
                : args.tournament,
    };

    return (
        destroy.definition.url
            .replace('{tournament}', parsedArgs.tournament.toString())
            .replace(/\/+$/, '') + queryParams(options)
    );
};

/**
 * @see \App\Http\Controllers\TournamentController::destroy
 * @see app/Http/Controllers/TournamentController.php:122
 * @route '/tournaments/{tournament}'
 */
destroy.delete = (
    args:
        | { tournament: number | { id: number } }
        | [tournament: number | { id: number }]
        | number
        | { id: number },
    options?: RouteQueryOptions,
): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
});

/**
 * @see \App\Http\Controllers\TournamentController::destroy
 * @see app/Http/Controllers/TournamentController.php:122
 * @route '/tournaments/{tournament}'
 */
const destroyForm = (
    args:
        | { tournament: number | { id: number } }
        | [tournament: number | { id: number }]
        | number
        | { id: number },
    options?: RouteQueryOptions,
): RouteFormDefinition<'post'> => ({
    action: destroy.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'DELETE',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        },
    }),
    method: 'post',
});

/**
 * @see \App\Http\Controllers\TournamentController::destroy
 * @see app/Http/Controllers/TournamentController.php:122
 * @route '/tournaments/{tournament}'
 */
destroyForm.delete = (
    args:
        | { tournament: number | { id: number } }
        | [tournament: number | { id: number }]
        | number
        | { id: number },
    options?: RouteQueryOptions,
): RouteFormDefinition<'post'> => ({
    action: destroy.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'DELETE',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        },
    }),
    method: 'post',
});

destroy.form = destroyForm;
const tournaments = {
    index: Object.assign(index, index),
    create: Object.assign(create, create),
    store: Object.assign(store, store),
    show: Object.assign(show, show),
    edit: Object.assign(edit, edit),
    update: Object.assign(update, update),
    destroy: Object.assign(destroy, destroy),
};

export default tournaments;
