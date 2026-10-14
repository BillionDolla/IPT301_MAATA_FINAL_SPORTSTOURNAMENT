<?php

namespace App\Http\Responses\Concerns;

use App\Models\Team;
use Illuminate\Http\Request;

trait RedirectsToCurrentTeam
{
    protected function teamDashboardPath(Request $request): string
    {
        return route('team.dashboard', ['current_team' => $this->currentTeam($request)->slug]);
    }

    protected function currentTeam(Request $request): Team
    {
        $user = $request->user();

        abort_if(! $user, 403);

        $team = $user->currentTeam ?? $user->personalTeam();

        abort_if(! $team, 403);

        return $team;
    }
}
