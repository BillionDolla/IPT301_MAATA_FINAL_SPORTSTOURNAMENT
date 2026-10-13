<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\SportsTeamController;
use App\Http\Controllers\TournamentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------|
| Web Routes
|--------------------------------------------------------------------------|
*/

Route::get('/', [SportsTeamController::class, 'index'])->name('home');

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Sports Teams CRUD
Route::resource('teams', SportsTeamController::class)->names([
    'index' => 'sports-teams.index',
    'create' => 'sports-teams.create',
    'store' => 'sports-teams.store',
    'show' => 'sports-teams.show',
    'edit' => 'sports-teams.edit',
    'update' => 'sports-teams.update',
    'destroy' => 'sports-teams.destroy',
]);

// Players CRUD
Route::resource('players', PlayerController::class)->names([
    'index' => 'players.index',
    'create' => 'players.create',
    'store' => 'players.store',
    'show' => 'players.show',
    'edit' => 'players.edit',
    'update' => 'players.update',
    'destroy' => 'players.destroy',
]);

// Tournaments CRUD
Route::resource('tournaments', TournamentController::class)->names([
    'index' => 'tournaments.index',
    'create' => 'tournaments.create',
    'store' => 'tournaments.store',
    'show' => 'tournaments.show',
    'edit' => 'tournaments.edit',
    'update' => 'tournaments.update',
    'destroy' => 'tournaments.destroy',
]);

// Matches CRUD
Route::resource('matches', MatchController::class)->names([
    'index' => 'matches.index',
    'create' => 'matches.create',
    'store' => 'matches.store',
    'show' => 'matches.show',
    'edit' => 'matches.edit',
    'update' => 'matches.update',
    'destroy' => 'matches.destroy',
]);

// Score update on match page
Route::post('matches/{match}/score', [MatchController::class, 'updateScore'])->name('matches.updateScore');

// Scores CRUD
Route::resource('scores', ScoreController::class)->names([
    'index' => 'scores.index',
    'create' => 'scores.create',
    'store' => 'scores.store',
    'show' => 'scores.show',
    'edit' => 'scores.edit',
    'update' => 'scores.update',
    'destroy' => 'scores.destroy',
]);

require __DIR__.'/settings.php';
