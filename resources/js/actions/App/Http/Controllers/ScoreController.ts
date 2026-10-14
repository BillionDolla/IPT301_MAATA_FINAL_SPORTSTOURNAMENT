import {
    queryParams,
    type RouteQueryOptions,
    type RouteDefinition,
    type RouteFormDefinition,
    applyUrlDefaults,
} from './../../../../wayfinder';
/**
 * @see \App\Http\Controllers\ScoreController::index
 * @see app/Http/Controllers/ScoreController.php:19
 * @route '/scores'
 */
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
});

index.definition = {
    methods: ['get', 'head'],
    url: '/scores',
} satisfies RouteDefinition<['get', 'head']>;

/**
 * @see \App\Http\Controllers\ScoreController::index
 * @see app/Http/Controllers/ScoreController.php:19
 * @route '/scores'
 */
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options);
};

/**
 * @see \App\Http\Controllers\ScoreController::index
 * @see app/Http/Controllers/ScoreController.php:19
 * @route '/scores'
 */
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
});
/**
 * @see \App\Http\Controllers\ScoreController::index
 * @see app/Http/Controllers/ScoreController.php:19
 * @route '/scores'
 */
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
});

/**
 * @see \App\Http\Controllers\ScoreController::index
 * @see app/Http/Controllers/ScoreController.php:19
 * @route '/scores'
 */
const indexForm = (
    options?: RouteQueryOptions,
): RouteFormDefinition<'get'> => ({
    action: index.url(options),
    method: 'get',
});

/**
 * @see \App\Http\Controllers\ScoreController::index
 * @see app/Http/Controllers/ScoreController.php:19
 * @route '/scores'
 */
indexForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url(options),
    method: 'get',
});
/**
 * @see \App\Http\Controllers\ScoreController::index
 * @see app/Http/Controllers/ScoreController.php:19
 * @route '/scores'
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
 * @see \App\Http\Controllers\ScoreController::create
 * @see app/Http/Controllers/ScoreController.php:47
 * @route '/scores/create'
 */
export const create = (
    options?: RouteQueryOptions,
): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
});

create.definition = {
    methods: ['get', 'head'],
    url: '/scores/create',
} satisfies RouteDefinition<['get', 'head']>;

/**
 * @see \App\Http\Controllers\ScoreController::create
 * @see app/Http/Controllers/ScoreController.php:47
 * @route '/scores/create'
 */
create.url = (options?: RouteQueryOptions) => {
    return create.definition.url + queryParams(options);
};

/**
 * @see \App\Http\Controllers\ScoreController::create
 * @see app/Http/Controllers/ScoreController.php:47
 * @route '/scores/create'
 */
create.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
});
/**
 * @see \App\Http\Controllers\ScoreController::create
 * @see app/Http/Controllers/ScoreController.php:47
 * @route '/scores/create'
 */
create.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: create.url(options),
    method: 'head',
});

/**
 * @see \App\Http\Controllers\ScoreController::create
 * @see app/Http/Controllers/ScoreController.php:47
 * @route '/scores/create'
 */
const createForm = (
    options?: RouteQueryOptions,
): RouteFormDefinition<'get'> => ({
    action: create.url(options),
    method: 'get',
});

/**
 * @see \App\Http\Controllers\ScoreController::create
 * @see app/Http/Controllers/ScoreController.php:47
 * @route '/scores/create'
 */
createForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: create.url(options),
    method: 'get',
});
/**
 * @see \App\Http\Controllers\ScoreController::create
 * @see app/Http/Controllers/ScoreController.php:47
 * @route '/scores/create'
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
 * @see \App\Http\Controllers\ScoreController::store
 * @see app/Http/Controllers/ScoreController.php:72
 * @route '/scores'
 */
export const store = (
    options?: RouteQueryOptions,
): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
});

store.definition = {
    methods: ['post'],
    url: '/scores',
} satisfies RouteDefinition<['post']>;

/**
 * @see \App\Http\Controllers\ScoreController::store
 * @see app/Http/Controllers/ScoreController.php:72
 * @route '/scores'
 */
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options);
};

/**
 * @see \App\Http\Controllers\ScoreController::store
 * @see app/Http/Controllers/ScoreController.php:72
 * @route '/scores'
 */
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
});

/**
 * @see \App\Http\Controllers\ScoreController::store
 * @see app/Http/Controllers/ScoreController.php:72
 * @route '/scores'
 */
const storeForm = (
    options?: RouteQueryOptions,
): RouteFormDefinition<'post'> => ({
    action: store.url(options),
    method: 'post',
});

/**
 * @see \App\Http\Controllers\ScoreController::store
 * @see app/Http/Controllers/ScoreController.php:72
 * @route '/scores'
 */
storeForm.post = (
    options?: RouteQueryOptions,
): RouteFormDefinition<'post'> => ({
    action: store.url(options),
    method: 'post',
});

store.form = storeForm;
/**
 * @see \App\Http\Controllers\ScoreController::show
 * @see app/Http/Controllers/ScoreController.php:86
 * @route '/scores/{score}'
 */
export const show = (
    args:
        | { score: number | { id: number } }
        | [score: number | { id: number }]
        | number
        | { id: number },
    options?: RouteQueryOptions,
): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
});

show.definition = {
    methods: ['get', 'head'],
    url: '/scores/{score}',
} satisfies RouteDefinition<['get', 'head']>;

/**
 * @see \App\Http\Controllers\ScoreController::show
 * @see app/Http/Controllers/ScoreController.php:86
 * @route '/scores/{score}'
 */
show.url = (
    args:
        | { score: number | { id: number } }
        | [score: number | { id: number }]
        | number
        | { id: number },
    options?: RouteQueryOptions,
) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { score: args };
    }

    if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
        args = { score: args.id };
    }

    if (Array.isArray(args)) {
        args = {
            score: args[0],
        };
    }

    args = applyUrlDefaults(args);

    const parsedArgs = {
        score: typeof args.score === 'object' ? args.score.id : args.score,
    };

    return (
        show.definition.url
            .replace('{score}', parsedArgs.score.toString())
            .replace(/\/+$/, '') + queryParams(options)
    );
};

/**
 * @see \App\Http\Controllers\ScoreController::show
 * @see app/Http/Controllers/ScoreController.php:86
 * @route '/scores/{score}'
 */
show.get = (
    args:
        | { score: number | { id: number } }
        | [score: number | { id: number }]
        | number
        | { id: number },
    options?: RouteQueryOptions,
): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
});
/**
 * @see \App\Http\Controllers\ScoreController::show
 * @see app/Http/Controllers/ScoreController.php:86
 * @route '/scores/{score}'
 */
show.head = (
    args:
        | { score: number | { id: number } }
        | [score: number | { id: number }]
        | number
        | { id: number },
    options?: RouteQueryOptions,
): RouteDefinition<'head'> => ({
    url: show.url(args, options),
    method: 'head',
});

/**
 * @see \App\Http\Controllers\ScoreController::show
 * @see app/Http/Controllers/ScoreController.php:86
 * @route '/scores/{score}'
 */
const showForm = (
    args:
        | { score: number | { id: number } }
        | [score: number | { id: number }]
        | number
        | { id: number },
    options?: RouteQueryOptions,
): RouteFormDefinition<'get'> => ({
    action: show.url(args, options),
    method: 'get',
});

/**
 * @see \App\Http\Controllers\ScoreController::show
 * @see app/Http/Controllers/ScoreController.php:86
 * @route '/scores/{score}'
 */
showForm.get = (
    args:
        | { score: number | { id: number } }
        | [score: number | { id: number }]
        | number
        | { id: number },
    options?: RouteQueryOptions,
): RouteFormDefinition<'get'> => ({
    action: show.url(args, options),
    method: 'get',
});
/**
 * @see \App\Http\Controllers\ScoreController::show
 * @see app/Http/Controllers/ScoreController.php:86
 * @route '/scores/{score}'
 */
showForm.head = (
    args:
        | { score: number | { id: number } }
        | [score: number | { id: number }]
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
 * @see \App\Http\Controllers\ScoreController::edit
 * @see app/Http/Controllers/ScoreController.php:96
 * @route '/scores/{score}/edit'
 */
export const edit = (
    args:
        | { score: number | { id: number } }
        | [score: number | { id: number }]
        | number
        | { id: number },
    options?: RouteQueryOptions,
): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
});

edit.definition = {
    methods: ['get', 'head'],
    url: '/scores/{score}/edit',
} satisfies RouteDefinition<['get', 'head']>;

/**
 * @see \App\Http\Controllers\ScoreController::edit
 * @see app/Http/Controllers/ScoreController.php:96
 * @route '/scores/{score}/edit'
 */
edit.url = (
    args:
        | { score: number | { id: number } }
        | [score: number | { id: number }]
        | number
        | { id: number },
    options?: RouteQueryOptions,
) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { score: args };
    }

    if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
        args = { score: args.id };
    }

    if (Array.isArray(args)) {
        args = {
            score: args[0],
        };
    }

    args = applyUrlDefaults(args);

    const parsedArgs = {
        score: typeof args.score === 'object' ? args.score.id : args.score,
    };

    return (
        edit.definition.url
            .replace('{score}', parsedArgs.score.toString())
            .replace(/\/+$/, '') + queryParams(options)
    );
};

/**
 * @see \App\Http\Controllers\ScoreController::edit
 * @see app/Http/Controllers/ScoreController.php:96
 * @route '/scores/{score}/edit'
 */
edit.get = (
    args:
        | { score: number | { id: number } }
        | [score: number | { id: number }]
        | number
        | { id: number },
    options?: RouteQueryOptions,
): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
});
/**
 * @see \App\Http\Controllers\ScoreController::edit
 * @see app/Http/Controllers/ScoreController.php:96
 * @route '/scores/{score}/edit'
 */
edit.head = (
    args:
        | { score: number | { id: number } }
        | [score: number | { id: number }]
        | number
        | { id: number },
    options?: RouteQueryOptions,
): RouteDefinition<'head'> => ({
    url: edit.url(args, options),
    method: 'head',
});

/**
 * @see \App\Http\Controllers\ScoreController::edit
 * @see app/Http/Controllers/ScoreController.php:96
 * @route '/scores/{score}/edit'
 */
const editForm = (
    args:
        | { score: number | { id: number } }
        | [score: number | { id: number }]
        | number
        | { id: number },
    options?: RouteQueryOptions,
): RouteFormDefinition<'get'> => ({
    action: edit.url(args, options),
    method: 'get',
});

/**
 * @see \App\Http\Controllers\ScoreController::edit
 * @see app/Http/Controllers/ScoreController.php:96
 * @route '/scores/{score}/edit'
 */
editForm.get = (
    args:
        | { score: number | { id: number } }
        | [score: number | { id: number }]
        | number
        | { id: number },
    options?: RouteQueryOptions,
): RouteFormDefinition<'get'> => ({
    action: edit.url(args, options),
    method: 'get',
});
/**
 * @see \App\Http\Controllers\ScoreController::edit
 * @see app/Http/Controllers/ScoreController.php:96
 * @route '/scores/{score}/edit'
 */
editForm.head = (
    args:
        | { score: number | { id: number } }
        | [score: number | { id: number }]
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
 * @see \App\Http\Controllers\ScoreController::update
 * @see app/Http/Controllers/ScoreController.php:117
 * @route '/scores/{score}'
 */
export const update = (
    args:
        | { score: number | { id: number } }
        | [score: number | { id: number }]
        | number
        | { id: number },
    options?: RouteQueryOptions,
): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
});

update.definition = {
    methods: ['put', 'patch'],
    url: '/scores/{score}',
} satisfies RouteDefinition<['put', 'patch']>;

/**
 * @see \App\Http\Controllers\ScoreController::update
 * @see app/Http/Controllers/ScoreController.php:117
 * @route '/scores/{score}'
 */
update.url = (
    args:
        | { score: number | { id: number } }
        | [score: number | { id: number }]
        | number
        | { id: number },
    options?: RouteQueryOptions,
) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { score: args };
    }

    if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
        args = { score: args.id };
    }

    if (Array.isArray(args)) {
        args = {
            score: args[0],
        };
    }

    args = applyUrlDefaults(args);

    const parsedArgs = {
        score: typeof args.score === 'object' ? args.score.id : args.score,
    };

    return (
        update.definition.url
            .replace('{score}', parsedArgs.score.toString())
            .replace(/\/+$/, '') + queryParams(options)
    );
};

/**
 * @see \App\Http\Controllers\ScoreController::update
 * @see app/Http/Controllers/ScoreController.php:117
 * @route '/scores/{score}'
 */
update.put = (
    args:
        | { score: number | { id: number } }
        | [score: number | { id: number }]
        | number
        | { id: number },
    options?: RouteQueryOptions,
): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
});
/**
 * @see \App\Http\Controllers\ScoreController::update
 * @see app/Http/Controllers/ScoreController.php:117
 * @route '/scores/{score}'
 */
update.patch = (
    args:
        | { score: number | { id: number } }
        | [score: number | { id: number }]
        | number
        | { id: number },
    options?: RouteQueryOptions,
): RouteDefinition<'patch'> => ({
    url: update.url(args, options),
    method: 'patch',
});

/**
 * @see \App\Http\Controllers\ScoreController::update
 * @see app/Http/Controllers/ScoreController.php:117
 * @route '/scores/{score}'
 */
const updateForm = (
    args:
        | { score: number | { id: number } }
        | [score: number | { id: number }]
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
 * @see \App\Http\Controllers\ScoreController::update
 * @see app/Http/Controllers/ScoreController.php:117
 * @route '/scores/{score}'
 */
updateForm.put = (
    args:
        | { score: number | { id: number } }
        | [score: number | { id: number }]
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
 * @see \App\Http\Controllers\ScoreController::update
 * @see app/Http/Controllers/ScoreController.php:117
 * @route '/scores/{score}'
 */
updateForm.patch = (
    args:
        | { score: number | { id: number } }
        | [score: number | { id: number }]
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
 * @see \App\Http\Controllers\ScoreController::destroy
 * @see app/Http/Controllers/ScoreController.php:133
 * @route '/scores/{score}'
 */
export const destroy = (
    args:
        | { score: number | { id: number } }
        | [score: number | { id: number }]
        | number
        | { id: number },
    options?: RouteQueryOptions,
): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
});

destroy.definition = {
    methods: ['delete'],
    url: '/scores/{score}',
} satisfies RouteDefinition<['delete']>;

/**
 * @see \App\Http\Controllers\ScoreController::destroy
 * @see app/Http/Controllers/ScoreController.php:133
 * @route '/scores/{score}'
 */
destroy.url = (
    args:
        | { score: number | { id: number } }
        | [score: number | { id: number }]
        | number
        | { id: number },
    options?: RouteQueryOptions,
) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { score: args };
    }

    if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
        args = { score: args.id };
    }

    if (Array.isArray(args)) {
        args = {
            score: args[0],
        };
    }

    args = applyUrlDefaults(args);

    const parsedArgs = {
        score: typeof args.score === 'object' ? args.score.id : args.score,
    };

    return (
        destroy.definition.url
            .replace('{score}', parsedArgs.score.toString())
            .replace(/\/+$/, '') + queryParams(options)
    );
};

/**
 * @see \App\Http\Controllers\ScoreController::destroy
 * @see app/Http/Controllers/ScoreController.php:133
 * @route '/scores/{score}'
 */
destroy.delete = (
    args:
        | { score: number | { id: number } }
        | [score: number | { id: number }]
        | number
        | { id: number },
    options?: RouteQueryOptions,
): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
});

/**
 * @see \App\Http\Controllers\ScoreController::destroy
 * @see app/Http/Controllers/ScoreController.php:133
 * @route '/scores/{score}'
 */
const destroyForm = (
    args:
        | { score: number | { id: number } }
        | [score: number | { id: number }]
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
 * @see \App\Http\Controllers\ScoreController::destroy
 * @see app/Http/Controllers/ScoreController.php:133
 * @route '/scores/{score}'
 */
destroyForm.delete = (
    args:
        | { score: number | { id: number } }
        | [score: number | { id: number }]
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
const ScoreController = { index, create, store, show, edit, update, destroy };

export default ScoreController;
