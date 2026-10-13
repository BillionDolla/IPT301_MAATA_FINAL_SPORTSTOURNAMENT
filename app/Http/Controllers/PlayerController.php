<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlayerRequest;
use App\Http\Requests\UpdatePlayerRequest;
use App\Models\Player;
use App\Models\SportsTeam;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Player::query()
            ->with('team')
            ->withCount('scores');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('full_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('team_id')) {
            $query->where('team_id', $request->input('team_id'));
        }

        if ($request->filled('position')) {
            $query->where('position', $request->input('position'));
        }

        if ($request->filled('status')) {
            $query->where('player_status', $request->input('status'));
        }

        $players = $query->latest()->paginate(15)->withQueryString();
        $teams = SportsTeam::where('is_active', true)->orderBy('name')->get();

        return view('players.index', compact('players', 'teams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $teams = SportsTeam::where('is_active', true)->orderBy('name')->get();

        return view('players.create', compact('teams'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlayerRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['full_name'] = $data['first_name'].' '.$data['last_name'];

        $player = Player::create($data);

        return redirect()->route('players.show', $player)
            ->with('success', "Player \"{$player->full_name}\" has been created successfully.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Player $player): View
    {
        $player->load('team', 'scores.match.tournament', 'scores.team');

        $goals = $player->scores()
            ->whereNotIn('score_type', ['assist', 'chance_created', 'penalty_miss'])
            ->with('match.tournament')
            ->latest()
            ->limit(10)
            ->get();

        return view('players.show', compact('player', 'goals'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Player $player): View
    {
        $teams = SportsTeam::where('is_active', true)->orderBy('name')->get();

        return view('players.edit', compact('player', 'teams'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlayerRequest $request, Player $player): RedirectResponse
    {
        $data = $request->validated();
        $data['full_name'] = $data['first_name'].' '.$data['last_name'];

        $player->update($data);

        return redirect()->route('players.show', $player)
            ->with('success', "Player \"{$player->full_name}\" has been updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Player $player): RedirectResponse
    {
        if ($player->scores()->exists() || $player->assists()->exists()) {
            return redirect()->route('players.index')
                ->with('error', 'This player cannot be deleted while score events refer to them.');
        }

        $name = $player->full_name;
        $player->delete();

        return redirect()->route('players.index')
            ->with('success', "Player \"{$name}\" has been deleted successfully.");
    }
}
