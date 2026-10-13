<?php

namespace Database\Seeders;

use App\Models\Player;
use App\Models\Score;
use App\Models\SportsMatch;
use App\Models\SportsTeam;
use App\Models\Tournament;
use Illuminate\Database\Seeder;

class SportsTournamentSeeder extends Seeder
{
    public function run(): void
    {
        $teams = collect([
            ['name' => 'Harbor City FC', 'city' => 'Tagbilaran City', 'country' => 'Philippines', 'stadium' => 'Tagbilaran City Sports Complex', 'coach' => 'Marco Santos'],
            ['name' => 'Mountain United', 'city' => 'Loboc', 'country' => 'Philippines', 'stadium' => 'Loboc Municipal Sports Grounds', 'coach' => 'Lena Cruz'],
            ['name' => 'Capital Strikers', 'city' => 'Dauis', 'country' => 'Philippines', 'stadium' => 'Dauis Sports Complex', 'coach' => 'Rafael Lim'],
            ['name' => 'Coastal Rovers', 'city' => 'Panglao', 'country' => 'Philippines', 'stadium' => 'Panglao Sports Complex', 'coach' => 'Nina Reyes'],
        ])->map(fn (array $team) => SportsTeam::updateOrCreate(['name' => $team['name']], $team));

        foreach ($teams as $team) {
            if (! $team->players()->exists()) {
                Player::factory()->count(5)->create(['team_id' => $team->id]);
            }
        }

        $tournament = Tournament::firstOrCreate(
            ['name' => 'Maata Community Cup'],
            [
                'sport' => 'football',
                'tournament_type' => 'league',
                'max_teams' => 8,
                'start_date' => now()->toDateString(),
                'end_date' => now()->addWeeks(3)->toDateString(),
                'status' => 'ongoing',
                'venue' => 'Carlos P. Garcia Sports Complex, Tagbilaran City, Bohol',
                'city' => 'Tagbilaran City',
                'country' => 'Philippines',
                'organizer' => 'Maata Sports Association',
                'is_published' => true,
            ],
        );
        $tournament->update([
            'venue' => 'Carlos P. Garcia Sports Complex, Tagbilaran City, Bohol',
            'city' => 'Tagbilaran City',
            'country' => 'Philippines',
        ]);

        $match = SportsMatch::firstOrCreate(
            [
                'tournament_id' => $tournament->id,
                'home_team_id' => $teams[0]->id,
                'away_team_id' => $teams[1]->id,
                'match_type' => 'group',
                'group_name' => 'A',
            ],
            [
                'match_datetime' => now()->subDay(),
                'venue' => 'Carlos P. Garcia Sports Complex, Tagbilaran City, Bohol',
                'status' => 'completed',
                'home_score' => 2,
                'away_score' => 1,
            ],
        );
        $match->update(['venue' => 'Carlos P. Garcia Sports Complex, Tagbilaran City, Bohol']);

        if (! $match->scores()->exists()) {
            foreach ([
                [$teams[0], 'goal', 18],
                [$teams[0], 'penalty_goal', 61],
                [$teams[1], 'goal', 74],
            ] as [$team, $type, $minute]) {
                Score::create([
                    'match_id' => $match->id,
                    'player_id' => Player::where('team_id', $team->id)->firstOrFail()->id,
                    'team_id' => $team->id,
                    'score_type' => $type,
                    'minute' => $minute,
                    'second_half' => $minute > 45 ? 2 : 1,
                    'scored_at' => $match->match_datetime->copy()->addMinutes($minute),
                ]);
            }
        }

        $upcomingMatch = SportsMatch::firstOrCreate(
            [
                'tournament_id' => $tournament->id,
                'home_team_id' => $teams[2]->id,
                'away_team_id' => $teams[3]->id,
                'match_type' => 'group',
                'group_name' => 'A',
            ],
            [
                'match_datetime' => now()->addDay(),
                'venue' => 'Carlos P. Garcia Sports Complex, Tagbilaran City, Bohol',
                'status' => 'scheduled',
            ],
        );
        $upcomingMatch->update(['venue' => 'Carlos P. Garcia Sports Complex, Tagbilaran City, Bohol']);
    }
}
