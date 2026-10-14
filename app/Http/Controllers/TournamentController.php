<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTournamentRequest;
use App\Http\Requests\UpdateTournamentRequest;
use App\Models\SportsMatch;
use App\Models\SportsTeam;
use App\Models\Tournament;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class TournamentController extends Controller
{
    private const SUGGESTED_SPORTS = [
        'badminton', 'baseball', 'basketball', 'cricket', 'football', 'futsal',
        'golf', 'handball', 'hockey', 'netball', 'rugby', 'table tennis',
        'tennis', 'volleyball', 'wrestling',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Tournament::query()
            ->withCount('matches')
            ->withCount(['matches' => fn ($q) => $q->where('status', 'completed')]);

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('city', 'like', "%{$search}%")
                    ->orWhere('sport', 'like', "%{$search}%");
            });
        }

        if ($request->filled('sport')) {
            $query->where('sport', $request->input('sport'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $tournaments = $query->latest()->paginate(12)->withQueryString();
        $sports = collect(self::SUGGESTED_SPORTS)
            ->merge(Tournament::query()->distinct()->orderBy('sport')->pluck('sport'))
            ->unique()
            ->sort()
            ->values();

        return view('tournaments.index', compact('tournaments', 'sports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $sports = self::SUGGESTED_SPORTS;

        return view('tournaments.create', compact('sports'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTournamentRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $tournament = Tournament::create($data);

        return redirect()->route('tournaments.show', $tournament)
            ->with('success', "Tournament \"{$tournament->name}\" has been created successfully.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Tournament $tournament): View
    {
        $tournament->load([
            'matches.homeTeam',
            'matches.awayTeam',
            'matches.scores.player.team',
        ]);

        $matches = $tournament->matches()
            ->with(['homeTeam', 'awayTeam', 'scores.player'])
            ->orderBy('match_datetime')
            ->get();

        $teams = $matches
            ->map(fn (SportsMatch $match) => $match->homeTeam)
            ->merge($matches->map(fn (SportsMatch $match) => $match->awayTeam))
            ->filter()
            ->unique('id')
            ->values();
        /** @var Collection<int, SportsTeam> $teams */
        $teams = $teams;

        $stats = $this->computeTournamentStats($matches, $teams);

        return view('tournaments.show', compact('tournament', 'matches', 'teams', 'stats'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tournament $tournament): View
    {
        $sports = self::SUGGESTED_SPORTS;

        return view('tournaments.edit', compact('tournament', 'sports'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTournamentRequest $request, Tournament $tournament): RedirectResponse
    {
        $tournament->update($request->validated());

        return redirect()->route('tournaments.show', $tournament)
            ->with('success', "Tournament \"{$tournament->name}\" has been updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tournament $tournament): RedirectResponse
    {
        if ($tournament->matches()->exists()) {
            return redirect()->route('tournaments.index')
                ->with('error', 'This tournament cannot be deleted while it has matches. Remove those matches first.');
        }

        $name = $tournament->name;
        $tournament->delete();

        return redirect()->route('tournaments.index')
            ->with('success', "Tournament \"{$name}\" has been deleted successfully.");
    }

    /**
     * Compute tournament statistics.
     *
     * @param  EloquentCollection<int, SportsMatch>  $matches
     * @param  Collection<int, SportsTeam>  $teams
     * @return array<string, mixed>
     */
    protected function computeTournamentStats(EloquentCollection $matches, Collection $teams): array
    {
        $completedMatches = $matches->where('status', 'completed');
        $totalPoints = 0;
        $topScorer = null;
        $topScorerPoints = 0;

        foreach ($matches as $match) {
            $totalPoints += $match->home_score + $match->away_score;
        }

        foreach ($teams as $team) {
            $points = $matches->where('home_team_id', $team->id)->sum('home_score')
                + $matches->where('away_team_id', $team->id)->sum('away_score');
            if ($points > $topScorerPoints) {
                $topScorerPoints = $points;
                $topScorer = $team;
            }
        }

        return [
            'total_matches' => $matches->count(),
            'completed_matches' => $completedMatches->count(),
            'total_points' => $totalPoints,
            'top_scoring_team' => $topScorer,
            'top_scoring_team_points' => $topScorerPoints,
            'average_points_per_match' => $matches->count() > 0 ? round($totalPoints / $matches->count(), 1) : 0,
        ];
    }
}
