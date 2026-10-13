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

## Deploying to Vercel

The repository includes a Vercel PHP function entry point and configuration. In your Vercel project, use the repository root as the Root Directory and leave the configured build command (`npm run build`) and output directory (`public`) unchanged. The deployment builds frontend assets with Vite and serves Laravel through the `vercel-php` runtime.

Before deploying, add these environment variables in **Vercel → Project → Settings → Environment Variables** for Production (and Preview if needed):

| Variable | Value |
| --- | --- |
| `APP_KEY` | A freshly generated Laravel key; run `php artisan key:generate --show` locally and copy the output |
| `APP_URL` | Your Vercel deployment URL, including `https://` |
| `DB_CONNECTION` | `mysql` or `pgsql` |
| `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` | Connection details for a persistent, publicly reachable managed database |

Do not use the repository's SQLite database in production: Vercel function filesystems are ephemeral and are not a persistent database. Use a managed MySQL or PostgreSQL service and ensure its network access permits Vercel connections. Run migrations against that database before using the app:

```powershell
$env:DB_CONNECTION = "mysql"
# Set DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, and DB_PASSWORD for the target database.
php artisan migrate --force
```

For PostgreSQL, set `DB_CONNECTION` to `pgsql`. If the database provider supplies a `DATABASE_URL`, configure Laravel's `DB_URL` variable instead of the individual connection fields. Never commit `APP_KEY`, database credentials, or `.env`; `.vercelignore` excludes local environment files and SQLite databases from deployments.

The Vercel configuration uses cookie sessions, in-memory cache, synchronous queues, stderr logging, and `/tmp` for compiled Blade views because function instances do not provide persistent writable application storage. User uploads and other persistent files should use object storage rather than the local filesystem.

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
