<?php

use App\Models\SportsTeam;
use App\Models\Tournament;

test('the dashboard shows tournament management totals', function () {
    SportsTeam::factory()->create();
    Tournament::factory()->create();

    $this->get(route('dashboard'))
        ->assertOk()
        ->assertViewIs('dashboard')
        ->assertViewHas('totalTeams', 1)
        ->assertViewHas('totalTournaments', 1);
});

test('the home page opens the sports team module', function () {
    $this->get('/')
        ->assertOk()
        ->assertViewIs('teams.index');
});
