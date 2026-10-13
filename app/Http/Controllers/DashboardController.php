<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Score;
use App\Models\SportsMatch;
use App\Models\SportsTeam;
use App\Models\Tournament;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('dashboard', [
            'totalTeams' => SportsTeam::count(),
            'activeTeams' => SportsTeam::where('is_active', true)->count(),
            'totalPlayers' => Player::count(),
            'totalTournaments' => Tournament::count(),
            'ongoingTournaments' => Tournament::where('status', 'ongoing')->count(),
            'completedTournaments' => Tournament::where('status', 'completed')->count(),
            'totalMatches' => SportsMatch::count(),
            'completedMatches' => SportsMatch::where('status', 'completed')->count(),
            'ongoingMatches' => SportsMatch::where('status', 'in_progress')->count(),
            'scheduledMatches' => SportsMatch::where('status', 'scheduled')->count(),
            'totalGoals' => SportsMatch::sum('home_score') + SportsMatch::sum('away_score'),
            'totalScores' => Score::count(),
            'upcomingMatches' => SportsMatch::with(['homeTeam', 'awayTeam', 'tournament'])
                ->where('status', 'scheduled')
                ->where('match_datetime', '>=', now())
                ->orderBy('match_datetime')
                ->limit(4)
                ->get(),
            'recentResults' => SportsMatch::with(['homeTeam', 'awayTeam', 'tournament'])
                ->whereIn('status', ['completed', 'in_progress'])
                ->latest('match_datetime')
                ->limit(5)
                ->get(),
        ]);
    }
}
