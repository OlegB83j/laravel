# Project Guidelines — Laravel User Management App

## Project Overview

A Laravel 11 web application providing user authentication and a simple dashboard with profile/settings pages. It uses MySQL by default (switchable to SQLite for simplicity), seeds 10 test users (2 admins + 8 general users), and provides login/logout functionality with role-based display. The app is server-rendered using Blade templates with no frontend JavaScript framework.

## Technology Stack

| Layer | Technology |
|-------|-----------|
| **Backend Framework** | Laravel 11 (PHP 8.2+) |
| **Templating** | Blade (server-rendered HTML) |
| **Database** | MySQL (configurable; SQLite also supported via config) |
| **Session/Cache** | Database-driven (`sessions` and `cache` tables) |
| **Asset Bundling** | Vite 5 with `laravel-vite-plugin` |
| **CSS** | Inline `<style>` in layout (no Tailwind/Bootstrap) |
| **JavaScript** | Minimal; Axios only (`resources/js/bootstrap.js`) |
| **Auth** | Custom `AuthController` (no Laravel Breeze/Jetstream) |

## Application Services

### Single Service: Laravel PHP Server
- **Process**: `php artisan serve --host=0.0.0.0 --port=8000`
- **Responsibilities**: Serves all HTTP requests, renders Blade views, handles authentication, manages sessions
- **Database**: MySQL or SQLite (configured via `.env`)

There is **no separate frontend build process needed** for production — the app uses inline styles in Blade layouts and Vite is only needed if `resources/css/app.css` or `resources/js/app.js` are referenced via `@vite` directive (currently they are not used in the Blade templates).

## Key Configuration Files

| File | Purpose |
|------|---------|
| `.env` / `.env.example` | Environment configuration (DB, app key, sessions, mail, etc.) |
| `config/database.php` | Database connection settings (sqlite, mysql, pgsql, etc.) |
| `config/session.php` | Session driver and cookie configuration |
| `config/app.php` | App name, env, debug, timezone, encryption key |
| `composer.json` | PHP dependencies |
| `package.json` | Node.js dev dependencies (Vite, Axios) |
| `vite.config.js` | Vite config with `laravel-vite-plugin` |

## Important Environment Variables

| Variable | Default | Description |
|----------|---------|-------------|
| `APP_KEY` | (none) | Must be generated via `php artisan key:generate` |
| `APP_URL` | `http://localhost` | Must match the preview URL for proper routing |
| `APP_DEBUG` | `true` | Enable detailed error pages |
| `DB_CONNECTION` | `mysql` | Database driver; can be set to `sqlite` |
| `DB_DATABASE` | `laravel` | Database name (or path for SQLite) |
| `SESSION_DRIVER` | `database` | Session storage driver |
| `CACHE_STORE` | `database` | Cache storage driver |

## Build & Run Instructions

### Prerequisites
- PHP 8.2+ with extensions: `pdo_sqlite` or `pdo_mysql`, `mbstring`, `xml`, `curl`, `zip`
- Composer (PHP dependency manager)
- MySQL server (or use SQLite by changing `DB_CONNECTION=sqlite`)

### Setup Steps
1. Copy `.env.example` to `.env`
2. Configure database credentials in `.env`
3. `composer install`
4. `php artisan key:generate`
5. `php artisan migrate --seed`
6. `php artisan serve --host=0.0.0.0 --port=8000`

### For SQLite (simpler, no MySQL required)
Set in `.env`:
```
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database/database.sqlite
SESSION_DRIVER=file
CACHE_STORE=file
```
Then create the SQLite file: `touch database/database.sqlite`

## Database Schema

### Users Table
- `id` (bigint, PK)
- `name` (string)
- `email` (string, unique)
- `email_verified_at` (timestamp, nullable)
- `password` (string, bcrypt hashed)
- `role` (string, default: 'general') — values: 'admin', 'general'
- `phone` (string, nullable)
- `is_active` (boolean, default: true)
- `job_title` (string, nullable)
- `remember_token`, `created_at`, `updated_at`

### Test Users (from `UserSeeder`)
- **Admins**: `admin1@example.com`, `admin2@example.com`
- **General users**: `user1@example.com` through `user8@example.com`
- **Password for all**: `password`

## Routing Structure

| Method | Path | Handler | Middleware |
|--------|------|---------|------------|
| GET | `/` | Redirect to dashboard or login | — |
| GET | `/login` | `AuthController@showLoginForm` | `guest` |
| POST | `/login` | `AuthController@login` | `guest` |
| POST | `/logout` | `AuthController@logout` | `auth` |
| GET | `/dashboard` | Closure → `dashboard` view | `auth` |
| GET | `/profile` | Closure → `profile` view | `auth` |
| GET | `/settings` | Closure → `settings` view | `auth` |

## UI Patterns & Style Guide

### Layout Pattern
All views extend `resources/views/layouts/app.blade.php` using Blade's `@extends` / `@section` / `@yield` directives.

```blade
@extends('layouts.app')
@section('title', 'Page Title')
@section('content')
    {{-- page content --}}
@endsection
```

### CSS Classes (defined inline in layout)
- **`.container`**: Max-width 960px, centered with padding
- **`.card`**: White background card with rounded corners and shadow
- **`.btn`**: Base button style
- **`.btn-primary`**: Blue primary button (#2563eb)
- **`.btn-secondary`**: Gray secondary button (#e2e8f0)
- **`.form-group`**: Form field wrapper with label + input styling
- **`.error`**: Red error text for validation messages
- **`.flex`**, **`.gap-4`**, **`.items-center`**: Flexbox utility classes

### Design Tokens
- **Font**: Figtree (loaded from fonts.bunny.net)
- **Background**: `#f8fafc`
- **Text color**: `#1e293b`
- **Muted text**: `#64748b` / `#475569`
- **Primary blue**: `#2563eb` (hover: `#1d4ed8`)
- **Border**: `#e2e8f0` / `#cbd5e1`
- **Success background**: `#ecfdf5` with text `#065f46`
- **Error color**: `#dc2626`

### Navigation
The layout includes a top nav bar (visible only for authenticated users) with links to Dashboard, Profile, and Settings. Active state uses `.active` class (bold + dark color). User name and role displayed on the right with logout button.

### Adding New Pages
1. Create a new Blade view in `resources/views/`
2. Extend the layout: `@extends('layouts.app')`
3. Add route in `routes/web.php` (inside the `auth` middleware group for protected pages)
4. Add nav link in `resources/views/layouts/app.blade.php` if needed

### Controller Pattern
- Controllers extend `App\Http\Controllers\Controller`
- Use constructor injection or method injection for dependencies
- Validation done inline via `$request->validate([...])`
- Return views or redirects

### Model Pattern
- Models are in `app/Models/`
- Use `HasFactory` and `Notifiable` traits
- Define `$fillable`, `$hidden`, and `casts()` method
- Password field uses `'hashed'` cast (auto-bcrypt)