<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreScoreRequest;
use App\Models\Player;
use App\Models\Score;
use App\Models\SportsMatch;
use App\Models\SportsTeam;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Score::query()
            ->with(['match.tournament', 'player.team', 'team']);

        if ($request->filled('match_id')) {
            $query->where('match_id', $request->input('match_id'));
        }

        if ($request->filled('team_id')) {
            $query->where('team_id', $request->input('team_id'));
        }

        if ($request->filled('score_type')) {
            $query->where('score_type', $request->input('score_type'));
        }

        $scores = $query->latest('scored_at')->paginate(20)->withQueryString();
        $matches = SportsMatch::with(['homeTeam', 'awayTeam'])->latest('match_datetime')->get();
        $teams = SportsTeam::where('is_active', true)->orderBy('name')->get();
        $scoreTypes = ['goal', 'own_goal', 'penalty_goal', 'free_kick', 'header', 'volley', 'assist', 'penalty_miss', 'chance_created'];

        return view('scores.index', compact('scores', 'matches', 'teams', 'scoreTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $matchId = $request->input('match_id');
        $match = $matchId
            ? SportsMatch::query()->with(['homeTeam', 'awayTeam'])->whereKey($matchId)->firstOrFail()
            : null;

        $teams = SportsTeam::query()
            ->when($match, fn ($query) => $query->whereIn('id', [$match->home_team_id, $match->away_team_id]))
            ->orderBy('name')
            ->get();
        $players = Player::whereIn('team_id', $teams->pluck('id'))
            ->where('player_status', 'active')
            ->orderBy('last_name')
            ->get();

        $scoreTypes = ['goal', 'own_goal', 'penalty_goal', 'free_kick', 'header', 'volley', 'assist', 'penalty_miss', 'chance_created'];
        $matches = SportsMatch::with(['homeTeam', 'awayTeam', 'tournament'])->latest('match_datetime')->get();

        return view('scores.create', compact('match', 'teams', 'players', 'scoreTypes', 'matches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreScoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['is_assisted'] = ! empty($data['assisted_by']);
        $score = Score::create($data);
        $this->refreshMatchScore($score->match_id);

        return redirect()->route('matches.show', $score->match_id)
            ->with('success', 'Score event has been recorded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Score $score): View
    {
        $score->load(['match.tournament', 'player.team', 'team', 'assistedBy.team']);

        return view('scores.show', compact('score'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Score $score): View
    {
        $score->load('match.homeTeam', 'match.awayTeam');
        $match = $score->match;
        $teams = SportsTeam::query()
            ->whereIn('id', [$score->match->home_team_id, $score->match->away_team_id])
            ->orderBy('name')
            ->get();
        $players = Player::whereIn('team_id', $teams->pluck('id'))
            ->where('player_status', 'active')
            ->orderBy('last_name')
            ->get();
        $scoreTypes = ['goal', 'own_goal', 'penalty_goal', 'free_kick', 'header', 'volley', 'assist', 'penalty_miss', 'chance_created'];
        $matches = SportsMatch::with(['homeTeam', 'awayTeam', 'tournament'])->latest('match_datetime')->get();

        return view('scores.edit', compact('score', 'match', 'teams', 'players', 'scoreTypes', 'matches'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreScoreRequest $request, Score $score): RedirectResponse
    {
        $oldMatchId = $score->match_id;
        $data = $request->validated();
        $data['is_assisted'] = ! empty($data['assisted_by']);
        $score->update($data);
        $this->refreshMatchScore($oldMatchId);
        $this->refreshMatchScore($score->match_id);

        return redirect()->route('matches.show', $score->match_id)
            ->with('success', 'Score event has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Score $score): RedirectResponse
    {
        $matchId = $score->match_id;
        $score->delete();
        $this->refreshMatchScore($matchId);

        return redirect()->route('matches.show', $matchId)
            ->with('success', 'Score event has been deleted successfully.');
    }

    private function refreshMatchScore(int $matchId): void
    {
        $match = SportsMatch::findOrFail($matchId);
        $goalTypes = ['goal', 'penalty_goal', 'free_kick', 'header', 'volley'];

        $homeGoals = $match->scores()->where('team_id', $match->home_team_id)->whereIn('score_type', $goalTypes)->count()
            + $match->scores()->where('team_id', $match->away_team_id)->where('score_type', 'own_goal')->count();
        $awayGoals = $match->scores()->where('team_id', $match->away_team_id)->whereIn('score_type', $goalTypes)->count()
            + $match->scores()->where('team_id', $match->home_team_id)->where('score_type', 'own_goal')->count();

        $match->update(['home_score' => $homeGoals, 'away_score' => $awayGoals]);
    }
}
