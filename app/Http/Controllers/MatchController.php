<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGameRequest;
use App\Http\Requests\UpdateGameRequest;
use App\Models\SportsMatch;
use App\Models\SportsTeam;
use App\Models\Tournament;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = SportsMatch::query()
            ->with(['tournament', 'homeTeam', 'awayTeam']);

        if ($request->filled('tournament_id')) {
            $query->where('tournament_id', $request->input('tournament_id'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('team_id')) {
            $query->where(function ($q) use ($request) {
                $q->where('home_team_id', $request->input('team_id'))
                    ->orWhere('away_team_id', $request->input('team_id'));
            });
        }

        $matches = $query->latest('match_datetime')->paginate(15)->withQueryString();
        $tournaments = Tournament::where('is_published', true)->orderBy('name')->get();
        $teams = SportsTeam::where('is_active', true)->orderBy('name')->get();

        return view('matches.index', compact('matches', 'tournaments', 'teams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $tournaments = Tournament::where('is_published', true)->orderBy('name')->get();
        $teams = SportsTeam::where('is_active', true)->orderBy('name')->get();
        $selectedTournament = $request->filled('tournament_id')
            ? Tournament::find($request->input('tournament_id'))
            : null;

        return view('matches.create', compact('tournaments', 'teams', 'selectedTournament'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGameRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $match = SportsMatch::create($data);

        return redirect()->route('matches.show', $match)
            ->with('success', 'Match has been scheduled successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SportsMatch $match): View
    {
        $match->load([
            'tournament',
            'homeTeam',
            'awayTeam',
            'scores.player.team',
            'scores.assistedBy',
        ]);

        $homeGoals = $match->scores()->where('team_id', $match->home_team_id)
            ->with('player', 'assistedBy')
            ->orderBy('minute')
            ->get();
        $awayGoals = $match->scores()->where('team_id', $match->away_team_id)
            ->with('player', 'assistedBy')
            ->orderBy('minute')
            ->get();

        $teams = SportsTeam::where('is_active', true)->orderBy('name')->get();
        $players = collect();

        return view('matches.show', compact('match', 'homeGoals', 'awayGoals', 'teams', 'players'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SportsMatch $match): View
    {
        $tournaments = Tournament::where('is_published', true)->orderBy('name')->get();
        $teams = SportsTeam::where('is_active', true)->orderBy('name')->get();

        return view('matches.edit', compact('match', 'tournaments', 'teams'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGameRequest $request, SportsMatch $match): RedirectResponse
    {
        $match->update($request->validated());

        return redirect()->route('matches.show', $match)
            ->with('success', 'Match has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SportsMatch $match): RedirectResponse
    {
        if ($match->scores()->exists()) {
            return redirect()->route('matches.index')
                ->with('error', 'This match cannot be deleted while it has score events. Remove those events first.');
        }

        $match->delete();

        return redirect()->route('matches.index')
            ->with('success', 'Match has been deleted successfully.');
    }

    /**
     * Update the score of a match.
     */
    public function updateScore(Request $request, SportsMatch $match): RedirectResponse
    {
        $validated = $request->validate([
            'home_score' => 'required|integer|min:0',
            'away_score' => 'required|integer|min:0',
            'status' => 'required|in:scheduled,in_progress,completed,postponed,cancelled,abandoned,forfeited,drawn',
            'overtime' => 'sometimes|boolean',
            'home_score_ot' => 'required_if:overtime,true|integer|min:0',
            'away_score_ot' => 'required_if:overtime,true|integer|min:0',
            'penalty_shootout' => 'sometimes|boolean',
            'home_score_penalties' => 'required_if:penalty_shootout,true|integer|min:0',
            'away_score_penalties' => 'required_if:penalty_shootout,true|integer|min:0',
            'match_notes' => 'nullable|string|max:1000',
        ]);

        $match->update($validated);

        return back()->with('success', 'Match score has been updated.');
    }
}
