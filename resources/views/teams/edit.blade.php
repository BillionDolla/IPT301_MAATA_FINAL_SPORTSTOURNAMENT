<x-layouts.app>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0"><i class="bi bi-pencil me-2"></i>Edit Team</h2>
        <a href="{{ route('sports-teams.show', $team) }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>Back
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Edit {{ $team->name }}</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('sports-teams.update', $team) }}">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Team Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @endif"
                                       value="{{ old('name', $team->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="coach" class="form-label">Coach</label>
                                <input type="text" name="coach" class="form-control @error('coach') is-invalid @endif"
                                       value="{{ old('coach', $team->coach) }}">
                                @error('coach')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="row g-3 mt-1">
                            <div class="col-md-4">
                                <label for="city" class="form-label">City / Municipality</label>
                                <input type="text" name="city" class="form-control @error('city') is-invalid @endif"
                                       value="{{ old('city', $team->city) }}" placeholder="e.g. Tagbilaran City">
                                @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <label for="country" class="form-label">Country</label>
                                <input type="text" name="country" class="form-control @error('country') is-invalid @endif"
                                       value="{{ old('country', $team->country ?? 'Philippines') }}">
                                @error('country')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <label for="founded_year" class="form-label">Founded Year</label>
                                <input type="number" name="founded_year" class="form-control @error('founded_year') is-invalid @endif"
                                       value="{{ old('founded_year', $team->founded_year) }}" min="1850" max="{{ date('Y') }}">
                                @error('founded_year')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="row g-3 mt-1">
                            <div class="col-md-6">
                                <label for="stadium" class="form-label">Stadium</label>
                                <input type="text" name="stadium" class="form-control @error('stadium') is-invalid @endif"
                                       value="{{ old('stadium', $team->stadium) }}">
                                @error('stadium')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="team_color" class="form-label">Team Color</label>
                                <input type="text" name="team_color" class="form-control @error('team_color') is-invalid @endif"
                                       value="{{ old('team_color', $team->team_color) }}">
                                @error('team_color')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="mt-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @endif"
                                      rows="3">{{ old('description', $team->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @endif
                        </div>

                        <div class="mt-3 form-check">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" class="form-check-input" id="is_active"
                                   value="1" {{ old('is_active', $team->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Active team</label>
                        </div>

                        <div class="mt-4 d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-1"></i>Update Team
                            </button>
                            <a href="{{ route('sports-teams.show', $team) }}" class="btn btn-outline-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>