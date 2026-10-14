<?php

use App\Models\Player;
use App\Models\Score;
use App\Models\SportsMatch;
use App\Models\SportsTeam;
use App\Models\Tournament;

test('a score event updates the linked match result and deletion recalculates it', function () {
    $homeTeam = SportsTeam::factory()->create();
    $awayTeam = SportsTeam::factory()->create();
    $player = Player::factory()->create(['team_id' => $homeTeam->id]);
    $tournament = Tournament::factory()->create();
    $match = SportsMatch::factory()->create([
        'tournament_id' => $tournament->id,
        'home_team_id' => $homeTeam->id,
        'away_team_id' => $awayTeam->id,
        'status' => 'in_progress',
    ]);

    $this->post(route('scores.store'), [
        'match_id' => $match->id,
        'team_id' => $homeTeam->id,
        'player_id' => $player->id,
        'score_type' => 'Three-point shot',
        'points' => 3,
        'minute' => 24,
        'period' => 2,
    ])->assertRedirect(route('matches.show', $match));

    $this->assertDatabaseHas('scores', ['match_id' => $match->id, 'player_id' => $player->id]);
    $this->assertDatabaseHas('matches', ['id' => $match->id, 'home_score' => 3, 'away_score' => 0]);

    $awayPlayer = Player::factory()->create(['team_id' => $awayTeam->id]);
    $this->post(route('scores.store'), [
        'match_id' => $match->id,
        'team_id' => $awayTeam->id,
        'player_id' => $awayPlayer->id,
        'score_type' => 'Basket',
        'points' => 2,
        'minute' => 30,
        'period' => 2,
    ])->assertRedirect(route('matches.show', $match));
    $this->assertDatabaseHas('matches', ['id' => $match->id, 'home_score' => 3, 'away_score' => 2]);

    $this->from(route('scores.create', ['match_id' => $match->id]))
        ->post(route('scores.store'), [
            'match_id' => $match->id,
            'team_id' => $homeTeam->id,
            'player_id' => $player->id,
            'score_type' => 'Three-point shot',
            'points' => 3,
            'minute' => 24,
            'period' => 2,
        ])
        ->assertSessionHasErrors('minute');

    $score = Score::query()->firstOrFail();
    $this->put(route('scores.update', $score), [
        'match_id' => $match->id,
        'team_id' => $homeTeam->id,
        'player_id' => $player->id,
        'score_type' => 'Three-point shot',
        'points' => 4,
        'minute' => 24,
        'period' => 2,
    ])->assertRedirect(route('matches.show', $match));
    $this->assertDatabaseHas('matches', ['id' => $match->id, 'home_score' => 4, 'away_score' => 2]);

    $this->delete(route('scores.destroy', $score))->assertRedirect(route('matches.show', $match));
    $this->assertDatabaseHas('matches', ['id' => $match->id, 'home_score' => 0, 'away_score' => 2]);
});

test('each resource supports creating and updating records', function () {
    $teams = [];
    foreach (['Home FC', 'Away FC'] as $name) {
        $this->post(route('sports-teams.store'), [
            'name' => $name,
            'city' => 'Tagbilaran City',
            'country' => 'Philippines',
            'is_active' => 1,
        ])->assertRedirect();
        $teams[] = SportsTeam::where('name', $name)->firstOrFail();
    }

    $this->put(route('sports-teams.update', $teams[0]), [
        'name' => 'Home City FC',
        'is_active' => 1,
    ])->assertRedirect(route('sports-teams.show', $teams[0]));
    $teams[0]->refresh();
    $this->assertSame('Home City FC', $teams[0]->name);

    $this->post(route('players.store'), [
        'team_id' => $teams[0]->id,
        'first_name' => 'Ari',
        'last_name' => 'Santos',
        'position' => 'Wing spiker',
        'player_status' => 'active',
        'is_captain' => 0,
    ])->assertRedirect();
    $player = Player::where('first_name', 'Ari')->firstOrFail();
    $this->assertSame('Wing spiker', $player->position);
    $this->put(route('players.update', $player), [
        'team_id' => $teams[0]->id,
        'first_name' => 'Ari',
        'last_name' => 'Reyes',
        'player_status' => 'active',
        'is_captain' => 0,
    ])->assertRedirect(route('players.show', $player));
    $this->assertSame('Ari Reyes', $player->fresh()->full_name);

    $startDate = now()->addDays(7);
    $tournamentData = [
        'name' => 'Community Cup',
        'sport' => 'Sepak Takraw',
        'tournament_type' => 'league',
        'max_teams' => 8,
        'start_date' => $startDate->toDateString(),
        'end_date' => $startDate->copy()->addWeeks(3)->toDateString(),
        'status' => 'registration_open',
        'is_published' => 1,
    ];
    $this->post(route('tournaments.store'), $tournamentData)->assertRedirect();
    $tournament = Tournament::where('name', 'Community Cup')->firstOrFail();
    $this->assertSame('Sepak Takraw', $tournament->sport);
    $tournamentData['name'] = 'Community Cup Finals';
    $this->put(route('tournaments.update', $tournament), $tournamentData)
        ->assertRedirect(route('tournaments.show', $tournament));
    $this->assertSame('Community Cup Finals', $tournament->fresh()->name);

    $matchData = [
        'tournament_id' => $tournament->id,
        'home_team_id' => $teams[0]->id,
        'away_team_id' => $teams[1]->id,
        'match_type' => 'group',
        'match_datetime' => $startDate->copy()->addDays(2)->format('Y-m-d H:i'),
        'status' => 'scheduled',
    ];
    $this->post(route('matches.store'), $matchData)->assertRedirect();
    $match = SportsMatch::firstOrFail();
    $matchData['status'] = 'completed';
    $this->put(route('matches.update', $match), $matchData)
        ->assertRedirect(route('matches.show', $match));
    $this->assertSame('completed', $match->fresh()->status);
});

test('score events cannot be recorded for a player outside the selected team', function () {
    $homeTeam = SportsTeam::factory()->create();
    $awayTeam = SportsTeam::factory()->create();
    $player = Player::factory()->create(['team_id' => $awayTeam->id]);
    $tournament = Tournament::factory()->create();
    $match = SportsMatch::factory()->create([
        'tournament_id' => $tournament->id,
        'home_team_id' => $homeTeam->id,
        'away_team_id' => $awayTeam->id,
    ]);

    $this->from(route('scores.create', ['match_id' => $match->id]))
        ->post(route('scores.store'), [
            'match_id' => $match->id,
            'team_id' => $homeTeam->id,
            'player_id' => $player->id,
            'score_type' => 'Score',
            'points' => 1,
            'minute' => 24,
        ])
        ->assertSessionHasErrors('player_id');

    $this->assertDatabaseCount('scores', 0);
});

test('the score factory connects generated events to the match team and player', function () {
    $score = Score::factory()->create();

    $this->assertSame($score->match->home_team_id, $score->team_id);
    $this->assertSame($score->team_id, $score->player->team_id);
    $this->assertSame(1, $score->match->fresh()->home_score);
});

test('all tournament management resource pages render', function () {
    $homeTeam = SportsTeam::factory()->create();
    $awayTeam = SportsTeam::factory()->create();
    $player = Player::factory()->create(['team_id' => $homeTeam->id]);
    $tournament = Tournament::factory()->create();
    $match = SportsMatch::factory()->create([
        'tournament_id' => $tournament->id,
        'home_team_id' => $homeTeam->id,
        'away_team_id' => $awayTeam->id,
    ]);
    $score = Score::create([
        'match_id' => $match->id,
        'player_id' => $player->id,
        'team_id' => $homeTeam->id,
        'score_type' => 'Score',
        'points' => 1,
        'minute' => 30,
        'scored_at' => now(),
    ]);

    $urls = [
        route('dashboard'),
        route('sports-teams.index'),
        route('sports-teams.create'),
        route('sports-teams.show', $homeTeam),
        route('sports-teams.edit', $homeTeam),
        route('players.index'),
        route('players.create'),
        route('players.show', $player),
        route('players.edit', $player),
        route('tournaments.index'),
        route('tournaments.create'),
        route('tournaments.show', $tournament),
        route('tournaments.edit', $tournament),
        route('matches.index'),
        route('matches.create'),
        route('matches.show', $match),
        route('matches.edit', $match),
        route('scores.index'),
        route('scores.create'),
        route('scores.show', $score),
        route('scores.edit', $score),
    ];

    foreach ($urls as $url) {
        $this->get($url)->assertOk();
    }
});

test('the database seeder creates connected demonstration tournament data', function () {
    $this->seed();

    $this->assertDatabaseCount('sports_teams', 4);
    $this->assertDatabaseHas('sports_teams', [
        'name' => 'Harbor City FC',
        'city' => 'Tagbilaran City',
        'country' => 'Philippines',
    ]);
    $this->assertDatabaseCount('players', 20);
    $this->assertDatabaseHas('tournaments', [
        'name' => 'Maata Community Cup',
        'sport' => 'basketball',
        'city' => 'Tagbilaran City',
        'country' => 'Philippines',
        'venue' => 'Carlos P. Garcia Sports Complex, Tagbilaran City, Bohol',
    ]);
    $this->assertDatabaseHas('tournaments', [
        'name' => 'Bohol Volleyball Invitational',
        'sport' => 'volleyball',
    ]);
    $this->assertDatabaseCount('tournaments', 2);
    $this->assertDatabaseCount('matches', 3);
    $this->assertDatabaseHas('matches', [
        'venue' => 'Carlos P. Garcia Sports Complex, Tagbilaran City, Bohol',
    ]);
    $this->assertDatabaseCount('scores', 3);
});
