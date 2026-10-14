# Basketball Tournament Management System

A Laravel application for managing basketball teams, players, tournaments, matches, and score events. The app uses Laravel MVC, Eloquent relationships, named resource routes, server-side validation, reusable Blade layouts, and Bootstrap 5.

## Features

- Dashboard totals, upcoming fixtures, and recent results
- Create, view, edit, and delete teams, players, tournaments, matches, and score events
- Team rosters and related tournament, fixture, and score-event details
- Server-side validation with clear errors and retained form input
- Match score updates from recorded score events
- Search/filter controls, pagination, and responsive Bootstrap navigation
- Repeatable sample tournament data for a quick demo

## Requirements

- PHP 8.3+ and the extensions required by Laravel
- Composer 2
- Node.js 22+ and npm
- SQLite (default) or a configured MySQL database

## Quick start from a Git clone

```bash
git clone <repository-url>
cd <repository-folder>
composer setup
php artisan serve
```

Open <http://127.0.0.1:8000>. `composer setup` installs dependencies, creates `.env` from `.env.example` when needed, generates an application key, creates the default SQLite file, migrates and seeds the database, then builds the frontend assets.

### Windows PowerShell

```powershell
git clone <repository-url>
Set-Location <repository-folder>
composer setup
php artisan serve
```

For MySQL, edit `.env` and set `DB_CONNECTION=mysql` plus the `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` values before running migrations. Never commit `.env` or real credentials.

### Manual setup

If you prefer to run setup steps individually:

```bash
composer install
cp .env.example .env
php artisan key:generate
```

On Windows PowerShell, replace the copy command with `Copy-Item .env.example .env`. For SQLite, make sure `database/database.sqlite` exists, then run:

```bash
php artisan migrate --seed
npm ci
npm run build
php artisan serve
```

## Data model

The project has exactly five tournament-domain tables and their related Eloquent models:

| Table          | Relationships                                                           |
| -------------- | ----------------------------------------------------------------------- |
| `sports_teams` | Has players and home/away matches                                       |
| `players`      | Belongs to a team; has recorded score events                            |
| `tournaments`  | Has matches                                                             |
| `matches`      | Belongs to a tournament and home/away teams; has score events           |
| `scores`       | Belongs to a match, player, and team; may reference an assisting player |

Framework and account tables (such as users, sessions, cache, and starter-kit teams) are separate from these five domain tables. The domain migrations are under `database/migrations`; factories and the sample seeder are under `database/factories` and `database/seeders`.

Score events are checked against the match’s participating teams and the player’s team. Recording, updating, or deleting an event recalculates the match result. Related records are protected from invalid deletion.

## Database commands

Seed sample records into an already-migrated database:

```bash
php artisan db:seed
```

Reset and rebuild the database, then reseed it:

```bash
php artisan migrate:fresh --seed
```

**Warning:** `migrate:fresh` deletes all tables and data in the selected database. Use it only for a disposable local database.

## Tests and quality checks

```bash
php artisan test
composer lint:check
composer types:check
npm run check
npm run types:check
```

The GitHub Actions workflow runs the setup and CI checks on pushes to `main` and pull requests.

## GitHub submission

Commit the source code, migrations, tests, factories, seeders, and `.env.example`. Keep `.env`, database files containing real data, credentials, and generated build artifacts out of Git. The repository's `.gitignore` excludes local environment files and generated dependencies.
