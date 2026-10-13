import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../../../wayfinder'
/**
* @see \App\Http\Controllers\SportsTeamController::index
 * @see app/Http/Controllers/SportsTeamController.php:17
 * @route '/'
 */
const index980bb49ee7ae63891f1d891d2fbcf1c9 = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index980bb49ee7ae63891f1d891d2fbcf1c9.url(options),
    method: 'get',
})

index980bb49ee7ae63891f1d891d2fbcf1c9.definition = {
    methods: ["get","head"],
    url: '/',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\SportsTeamController::index
 * @see app/Http/Controllers/SportsTeamController.php:17
 * @route '/'
 */
index980bb49ee7ae63891f1d891d2fbcf1c9.url = (options?: RouteQueryOptions) => {
    return index980bb49ee7ae63891f1d891d2fbcf1c9.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\SportsTeamController::index
 * @see app/Http/Controllers/SportsTeamController.php:17
 * @route '/'
 */
index980bb49ee7ae63891f1d891d2fbcf1c9.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index980bb49ee7ae63891f1d891d2fbcf1c9.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\SportsTeamController::index
 * @see app/Http/Controllers/SportsTeamController.php:17
 * @route '/'
 */
index980bb49ee7ae63891f1d891d2fbcf1c9.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index980bb49ee7ae63891f1d891d2fbcf1c9.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\SportsTeamController::index
 * @see app/Http/Controllers/SportsTeamController.php:17
 * @route '/'
 */
    const index980bb49ee7ae63891f1d891d2fbcf1c9Form = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: index980bb49ee7ae63891f1d891d2fbcf1c9.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\SportsTeamController::index
 * @see app/Http/Controllers/SportsTeamController.php:17
 * @route '/'
 */
        index980bb49ee7ae63891f1d891d2fbcf1c9Form.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: index980bb49ee7ae63891f1d891d2fbcf1c9.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\SportsTeamController::index
 * @see app/Http/Controllers/SportsTeamController.php:17
 * @route '/'
 */
        index980bb49ee7ae63891f1d891d2fbcf1c9Form.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: index980bb49ee7ae63891f1d891d2fbcf1c9.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    index980bb49ee7ae63891f1d891d2fbcf1c9.form = index980bb49ee7ae63891f1d891d2fbcf1c9Form
    /**
* @see \App\Http\Controllers\SportsTeamController::index
 * @see app/Http/Controllers/SportsTeamController.php:17
 * @route '/teams'
 */
const index5831cf4f42a3a2661a33631ccc0745ae = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index5831cf4f42a3a2661a33631ccc0745ae.url(options),
    method: 'get',
})

index5831cf4f42a3a2661a33631ccc0745ae.definition = {
    methods: ["get","head"],
    url: '/teams',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\SportsTeamController::index
 * @see app/Http/Controllers/SportsTeamController.php:17
 * @route '/teams'
 */
index5831cf4f42a3a2661a33631ccc0745ae.url = (options?: RouteQueryOptions) => {
    return index5831cf4f42a3a2661a33631ccc0745ae.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\SportsTeamController::index
 * @see app/Http/Controllers/SportsTeamController.php:17
 * @route '/teams'
 */
index5831cf4f42a3a2661a33631ccc0745ae.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index5831cf4f42a3a2661a33631ccc0745ae.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\SportsTeamController::index
 * @see app/Http/Controllers/SportsTeamController.php:17
 * @route '/teams'
 */
index5831cf4f42a3a2661a33631ccc0745ae.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index5831cf4f42a3a2661a33631ccc0745ae.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\SportsTeamController::index
 * @see app/Http/Controllers/SportsTeamController.php:17
 * @route '/teams'
 */
    const index5831cf4f42a3a2661a33631ccc0745aeForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: index5831cf4f42a3a2661a33631ccc0745ae.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\SportsTeamController::index
 * @see app/Http/Controllers/SportsTeamController.php:17
 * @route '/teams'
 */
        index5831cf4f42a3a2661a33631ccc0745aeForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: index5831cf4f42a3a2661a33631ccc0745ae.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\SportsTeamController::index
 * @see app/Http/Controllers/SportsTeamController.php:17
 * @route '/teams'
 */
        index5831cf4f42a3a2661a33631ccc0745aeForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: index5831cf4f42a3a2661a33631ccc0745ae.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    index5831cf4f42a3a2661a33631ccc0745ae.form = index5831cf4f42a3a2661a33631ccc0745aeForm

/**
* Multiple routes resolve to \App\Http\Controllers\SportsTeamController::index, so this export is a
* dictionary keyed by URI rather than a callable. Call a specific route with `index['<uri>'](...)`,
* or import the route by name from your generated `routes/` directory.
*/
export const index = {
    '/': index980bb49ee7ae63891f1d891d2fbcf1c9,
    '/teams': index5831cf4f42a3a2661a33631ccc0745ae,
}

/**
* @see \App\Http\Controllers\SportsTeamController::create
 * @see app/Http/Controllers/SportsTeamController.php:46
 * @route '/teams/create'
 */
export const create = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})

create.definition = {
    methods: ["get","head"],
    url: '/teams/create',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\SportsTeamController::create
 * @see app/Http/Controllers/SportsTeamController.php:46
 * @route '/teams/create'
 */
create.url = (options?: RouteQueryOptions) => {
    return create.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\SportsTeamController::create
 * @see app/Http/Controllers/SportsTeamController.php:46
 * @route '/teams/create'
 */
create.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\SportsTeamController::create
 * @see app/Http/Controllers/SportsTeamController.php:46
 * @route '/teams/create'
 */
create.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: create.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\SportsTeamController::create
 * @see app/Http/Controllers/SportsTeamController.php:46
 * @route '/teams/create'
 */
    const createForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: create.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\SportsTeamController::create
 * @see app/Http/Controllers/SportsTeamController.php:46
 * @route '/teams/create'
 */
        createForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: create.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\SportsTeamController::create
 * @see app/Http/Controllers/SportsTeamController.php:46
 * @route '/teams/create'
 */
        createForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: create.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    create.form = createForm
/**
* @see \App\Http\Controllers\SportsTeamController::store
 * @see app/Http/Controllers/SportsTeamController.php:54
 * @route '/teams'
 */
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/teams',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\SportsTeamController::store
 * @see app/Http/Controllers/SportsTeamController.php:54
 * @route '/teams'
 */
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\SportsTeamController::store
 * @see app/Http/Controllers/SportsTeamController.php:54
 * @route '/teams'
 */
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\SportsTeamController::store
 * @see app/Http/Controllers/SportsTeamController.php:54
 * @route '/teams'
 */
    const storeForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: store.url(options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\SportsTeamController::store
 * @see app/Http/Controllers/SportsTeamController.php:54
 * @route '/teams'
 */
        storeForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: store.url(options),
            method: 'post',
        })
    
    store.form = storeForm
/**
* @see \App\Http\Controllers\SportsTeamController::show
 * @see app/Http/Controllers/SportsTeamController.php:67
 * @route '/teams/{team}'
 */
export const show = (args: { team: number | { id: number } } | [team: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

show.definition = {
    methods: ["get","head"],
    url: '/teams/{team}',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\SportsTeamController::show
 * @see app/Http/Controllers/SportsTeamController.php:67
 * @route '/teams/{team}'
 */
show.url = (args: { team: number | { id: number } } | [team: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { team: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { team: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    team: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        team: typeof args.team === 'object'
                ? args.team.id
                : args.team,
                }

    return show.definition.url
            .replace('{team}', parsedArgs.team.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\SportsTeamController::show
 * @see app/Http/Controllers/SportsTeamController.php:67
 * @route '/teams/{team}'
 */
show.get = (args: { team: number | { id: number } } | [team: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\SportsTeamController::show
 * @see app/Http/Controllers/SportsTeamController.php:67
 * @route '/teams/{team}'
 */
show.head = (args: { team: number | { id: number } } | [team: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: show.url(args, options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\SportsTeamController::show
 * @see app/Http/Controllers/SportsTeamController.php:67
 * @route '/teams/{team}'
 */
    const showForm = (args: { team: number | { id: number } } | [team: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: show.url(args, options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\SportsTeamController::show
 * @see app/Http/Controllers/SportsTeamController.php:67
 * @route '/teams/{team}'
 */
        showForm.get = (args: { team: number | { id: number } } | [team: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: show.url(args, options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\SportsTeamController::show
 * @see app/Http/Controllers/SportsTeamController.php:67
 * @route '/teams/{team}'
 */
        showForm.head = (args: { team: number | { id: number } } | [team: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: show.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    show.form = showForm
/**
* @see \App\Http\Controllers\SportsTeamController::edit
 * @see app/Http/Controllers/SportsTeamController.php:86
 * @route '/teams/{team}/edit'
 */
export const edit = (args: { team: number | { id: number } } | [team: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})

edit.definition = {
    methods: ["get","head"],
    url: '/teams/{team}/edit',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\SportsTeamController::edit
 * @see app/Http/Controllers/SportsTeamController.php:86
 * @route '/teams/{team}/edit'
 */
edit.url = (args: { team: number | { id: number } } | [team: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { team: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { team: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    team: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        team: typeof args.team === 'object'
                ? args.team.id
                : args.team,
                }

    return edit.definition.url
            .replace('{team}', parsedArgs.team.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\SportsTeamController::edit
 * @see app/Http/Controllers/SportsTeamController.php:86
 * @route '/teams/{team}/edit'
 */
edit.get = (args: { team: number | { id: number } } | [team: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\SportsTeamController::edit
 * @see app/Http/Controllers/SportsTeamController.php:86
 * @route '/teams/{team}/edit'
 */
edit.head = (args: { team: number | { id: number } } | [team: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: edit.url(args, options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\SportsTeamController::edit
 * @see app/Http/Controllers/SportsTeamController.php:86
 * @route '/teams/{team}/edit'
 */
    const editForm = (args: { team: number | { id: number } } | [team: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: edit.url(args, options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\SportsTeamController::edit
 * @see app/Http/Controllers/SportsTeamController.php:86
 * @route '/teams/{team}/edit'
 */
        editForm.get = (args: { team: number | { id: number } } | [team: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: edit.url(args, options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\SportsTeamController::edit
 * @see app/Http/Controllers/SportsTeamController.php:86
 * @route '/teams/{team}/edit'
 */
        editForm.head = (args: { team: number | { id: number } } | [team: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: edit.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    edit.form = editForm
/**
* @see \App\Http\Controllers\SportsTeamController::update
 * @see app/Http/Controllers/SportsTeamController.php:94
 * @route '/teams/{team}'
 */
export const update = (args: { team: number | { id: number } } | [team: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

update.definition = {
    methods: ["put","patch"],
    url: '/teams/{team}',
} satisfies RouteDefinition<["put","patch"]>

/**
* @see \App\Http\Controllers\SportsTeamController::update
 * @see app/Http/Controllers/SportsTeamController.php:94
 * @route '/teams/{team}'
 */
update.url = (args: { team: number | { id: number } } | [team: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { team: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { team: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    team: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        team: typeof args.team === 'object'
                ? args.team.id
                : args.team,
                }

    return update.definition.url
            .replace('{team}', parsedArgs.team.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\SportsTeamController::update
 * @see app/Http/Controllers/SportsTeamController.php:94
 * @route '/teams/{team}'
 */
update.put = (args: { team: number | { id: number } } | [team: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})
/**
* @see \App\Http\Controllers\SportsTeamController::update
 * @see app/Http/Controllers/SportsTeamController.php:94
 * @route '/teams/{team}'
 */
update.patch = (args: { team: number | { id: number } } | [team: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'patch'> => ({
    url: update.url(args, options),
    method: 'patch',
})

    /**
* @see \App\Http\Controllers\SportsTeamController::update
 * @see app/Http/Controllers/SportsTeamController.php:94
 * @route '/teams/{team}'
 */
    const updateForm = (args: { team: number | { id: number } } | [team: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: update.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'PUT',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\SportsTeamController::update
 * @see app/Http/Controllers/SportsTeamController.php:94
 * @route '/teams/{team}'
 */
        updateForm.put = (args: { team: number | { id: number } } | [team: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: update.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'PUT',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
            /**
* @see \App\Http\Controllers\SportsTeamController::update
 * @see app/Http/Controllers/SportsTeamController.php:94
 * @route '/teams/{team}'
 */
        updateForm.patch = (args: { team: number | { id: number } } | [team: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: update.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'PATCH',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
    
    update.form = updateForm
/**
* @see \App\Http\Controllers\SportsTeamController::destroy
 * @see app/Http/Controllers/SportsTeamController.php:105
 * @route '/teams/{team}'
 */
export const destroy = (args: { team: number | { id: number } } | [team: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/teams/{team}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\SportsTeamController::destroy
 * @see app/Http/Controllers/SportsTeamController.php:105
 * @route '/teams/{team}'
 */
destroy.url = (args: { team: number | { id: number } } | [team: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { team: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { team: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    team: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        team: typeof args.team === 'object'
                ? args.team.id
                : args.team,
                }

    return destroy.definition.url
            .replace('{team}', parsedArgs.team.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\SportsTeamController::destroy
 * @see app/Http/Controllers/SportsTeamController.php:105
 * @route '/teams/{team}'
 */
destroy.delete = (args: { team: number | { id: number } } | [team: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

    /**
* @see \App\Http\Controllers\SportsTeamController::destroy
 * @see app/Http/Controllers/SportsTeamController.php:105
 * @route '/teams/{team}'
 */
    const destroyForm = (args: { team: number | { id: number } } | [team: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: destroy.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'DELETE',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\SportsTeamController::destroy
 * @see app/Http/Controllers/SportsTeamController.php:105
 * @route '/teams/{team}'
 */
        destroyForm.delete = (args: { team: number | { id: number } } | [team: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: destroy.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'DELETE',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
    
    destroy.form = destroyForm
const SportsTeamController = { index, create, store, show, edit, update, destroy }

export default SportsTeamController