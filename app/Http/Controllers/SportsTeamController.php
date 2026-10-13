<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSportsTeamRequest;
use App\Http\Requests\UpdateSportsTeamRequest;
use App\Models\SportsTeam;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SportsTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = SportsTeam::query()
            ->withCount('players')
            ->withCount('homeMatches')
            ->withCount('awayMatches');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('city', 'like', "%{$search}%")
                    ->orWhere('country', 'like', "%{$search}%")
                    ->orWhere('coach', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->input('status') === 'active');
        }

        $teams = $query->latest()->paginate(12)->withQueryString();

        return view('teams.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('teams.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSportsTeamRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $team = SportsTeam::create($data);

        return redirect()->route('sports-teams.show', $team)
            ->with('success', "Team \"{$team->name}\" has been created successfully.");
    }

    /**
     * Display the specified resource.
     */
    public function show(SportsTeam $team): View
    {
        $team->load([
            'players' => fn ($q) => $q->orderBy('last_name')->orderBy('first_name'),
            'homeMatches.tournament',
            'awayMatches.tournament',
        ]);

        $recentMatches = $team->homeMatches
            ->merge($team->awayMatches)
            ->sortByDesc('match_datetime')
            ->take(10);

        return view('teams.show', compact('team', 'recentMatches'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SportsTeam $team): View
    {
        return view('teams.edit', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSportsTeamRequest $request, SportsTeam $team): RedirectResponse
    {
        $team->update($request->validated());

        return redirect()->route('sports-teams.show', $team)
            ->with('success', "Team \"{$team->name}\" has been updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SportsTeam $team): RedirectResponse
    {
        if ($team->players()->exists() || $team->homeMatches()->exists() || $team->awayMatches()->exists()) {
            return redirect()->route('sports-teams.index')
                ->with('error', 'This team cannot be deleted while it has players or matches. Remove those records first.');
        }

        $name = $team->name;
        $team->delete();

        return redirect()->route('sports-teams.index')
            ->with('success', "Team \"{$name}\" has been deleted successfully.");
    }
}
