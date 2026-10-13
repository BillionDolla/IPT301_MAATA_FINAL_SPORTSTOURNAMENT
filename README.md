# Sports Tournament Management System

A Laravel application for managing sports teams, players, tournaments, matches, and score events. It uses Laravel MVC, Eloquent relationships, resource routes, server-side validation, Blade, and Bootstrap 5.

## Requirements

- PHP 8.3 or newer with the extensions required by Laravel
- Composer
- Node.js and npm for the starter kit's frontend assets

## Setup

1. Install PHP dependencies:

   ```powershell
   composer install
   ```

2. Create the local environment file and application key:

   ```powershell
   Copy-Item .env.example .env
   php artisan key:generate
   ```

3. The example environment uses SQLite. Create its local database file if it does not exist, then migrate and seed the sample tournament data:

   ```powershell
   if (-not (Test-Path database\database.sqlite)) { New-Item database\database.sqlite -ItemType File }
   php artisan migrate --seed
   ```

   For MySQL, configure the `DB_*` values in `.env` before migrating.

4. Install and build the frontend assets:

   ```powershell
   npm install
   npm run build
   ```

5. Start the development server:

   ```powershell
   php artisan serve
   ```

Open `http://127.0.0.1:8000`. The home page opens the team directory; use the navigation to access the dashboard, tournaments, players, matches, and score events.

## Domain tables and relationships

The project has exactly five tournament-domain tables:

| Table | Relationships |
| --- | --- |
| `sports_teams` | Has players and home/away matches |
| `players` | Belongs to a sports team; has score events |
| `tournaments` | Has matches |
| `matches` | Belongs to a tournament and two sports teams; has score events |
| `scores` | Belongs to a match, player, team, and optional assisting player |

Laravel's user, cache, queue, and starter-kit team tables remain separate framework/account tables. The five domain migrations are in `database/migrations`, and factories plus repeatable sample data are in `database/factories` and `database/seeders`.

Score events validate that the player belongs to the selected participating team. Goal events update the match result, and editing or deleting an event recalculates it. Teams, players, tournaments, and matches with dependent records cannot be deleted until those records are removed.

## Tests

Run the focused tournament-management feature tests with:

```powershell
php artisan test --filter=SportsTournamentTest
```

Run the complete suite with:

```powershell
php artisan test
```

Do not commit `.env` or database credentials. Use `.env.example` as the safe environment template.
