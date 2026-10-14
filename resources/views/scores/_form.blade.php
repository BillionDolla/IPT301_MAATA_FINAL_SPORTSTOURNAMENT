<div class="row g-3 mb-3">
    <div class="col-md-6"><label class="form-label" for="match_id">Match *</label>
        @if($match)<input type="hidden" name="match_id" id="match_id" value="{{ old('match_id',$match->id) }}" data-home="{{ $match->home_team_id }}" data-away="{{ $match->away_team_id }}"><input class="form-control" value="{{ $match->homeTeam->name }} vs {{ $match->awayTeam->name }} ({{ $match->match_datetime->format('M j, Y') }})" disabled>
        @else<select class="form-select" name="match_id" id="match_id" required><option value="">Select match</option>@foreach($matches as $item)<option value="{{ $item->id }}" data-home="{{ $item->home_team_id }}" data-away="{{ $item->away_team_id }}" @selected(old('match_id',$score?->match_id) == $item->id)>{{ $item->homeTeam->name }} vs {{ $item->awayTeam->name }} · {{ $item->tournament->name }} · {{ $item->match_datetime->format('M j, Y') }}</option>@endforeach</select>@endif
    </div>
    <div class="col-md-3"><label class="form-label" for="team_id">Scoring team *</label><select class="form-select" name="team_id" id="team_id" required><option value="">Select team</option>@foreach($teams as $team)<option value="{{ $team->id }}" data-team="{{ $team->id }}" @selected(old('team_id',$score?->team_id) == $team->id)>{{ $team->name }}</option>@endforeach</select></div>
    <div class="col-md-3"><label class="form-label" for="player_id">Player *</label><select class="form-select" name="player_id" id="player_id" required><option value="">Select player</option>@foreach($players as $player)<option value="{{ $player->id }}" data-team="{{ $player->team_id }}" @selected(old('player_id',$score?->player_id) == $player->id)>{{ $player->full_name }} — {{ $player->team->name }}</option>@endforeach</select></div>
    <div class="col-md-3"><label class="form-label" for="score_type">Event name *</label><input class="form-control" name="score_type" id="score_type" list="score-event-types" maxlength="100" required value="{{ old('score_type',$score?->score_type ?? 'Score') }}"><datalist id="score-event-types">@foreach(['Score','Goal','Basket','Try','Touchdown','Run','Point','Set point','Penalty','Assist','Foul','Rebound','Wicket','Ace'] as $type)<option value="{{ $type }}">@endforeach</datalist></div>
    <div class="col-md-3"><label class="form-label" for="points">Points *</label><input class="form-control" type="number" min="0" max="65535" name="points" id="points" required value="{{ old('points',$score?->points ?? 1) }}"><div class="form-text">Use 0 for events that do not change the result.</div></div>
    <div class="col-md-3"><label class="form-label" for="minute">Minute / time</label><input class="form-control" type="number" min="0" max="65535" name="minute" id="minute" value="{{ old('minute',$score?->minute) }}"></div>
    <div class="col-md-3"><label class="form-label" for="period">Period / set</label><input class="form-control" type="number" min="1" max="65535" name="period" id="period" value="{{ old('period',$score?->period) }}"></div>
    <div class="col-md-6"><label class="form-label" for="assisted_by">Assisted by</label><select class="form-select" name="assisted_by" id="assisted_by"><option value="">No assist</option>@foreach($players as $player)<option value="{{ $player->id }}" data-team="{{ $player->team_id }}" @selected(old('assisted_by',$score?->assisted_by) == $player->id)>{{ $player->full_name }} — {{ $player->team->name }}</option>@endforeach</select></div>
    <div class="col-md-6"><label class="form-label" for="description">Description</label><input class="form-control" name="description" id="description" value="{{ old('description',$score?->description) }}"></div>
</div>
@push('scripts')
<script>
    (() => {
        const match = document.getElementById('match_id');
        const team = document.getElementById('team_id');
        const playerSelects = [document.getElementById('player_id'), document.getElementById('assisted_by')];
        const filterOptions = (select, allowedIds, selectedId) => {
            [...select.options].forEach((option) => {
                const isAllowed = !option.value || allowedIds.includes(option.value);
                option.hidden = !isAllowed;
                option.disabled = !isAllowed;
            });
            select.value = allowedIds.includes(selectedId) ? selectedId : '';
        };
        const refreshChoices = () => {
            const selectedMatch = match.tagName === 'SELECT' ? match.selectedOptions[0] : match;
            const allowedTeams = selectedMatch ? [selectedMatch.dataset.home, selectedMatch.dataset.away] : [];
            filterOptions(team, allowedTeams, team.value);
            const selectedTeamId = team.value;
            playerSelects.forEach((select) => {
                const allowedPlayers = [...select.options]
                    .filter((option) => !option.value || (selectedTeamId && option.dataset.team === selectedTeamId))
                    .map((option) => option.value);
                filterOptions(select, allowedPlayers, select.value);
            });
        };
        if (match.tagName === 'SELECT') {
            match.addEventListener('change', () => {
                team.value = '';
                playerSelects.forEach((select) => { select.value = ''; });
                refreshChoices();
            });
        }
        team.addEventListener('change', refreshChoices);
        refreshChoices();
    })();
</script>
@endpush
