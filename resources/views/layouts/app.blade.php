<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name'))</title>
    <style>
        @import url('https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap');
        * { box-sizing: border-box; }
        body { font-family: 'Figtree', sans-serif; margin: 0; min-height: 100vh; background: #f1f5f9; color: #1e293b; }
        .container { max-width: 1000px; margin: 0 auto; padding: 0 1.5rem; }

        /* Nav */
        nav { background: #fff; border-bottom: 1px solid #e2e8f0; padding: 0; box-shadow: 0 1px 4px rgba(0,0,0,0.05); }
        nav .container { display: flex; align-items: stretch; justify-content: space-between; min-height: 60px; }
        .nav-brand { font-weight: 700; font-size: 1.1rem; color: #2563eb; display: flex; align-items: center; padding-right: 1.5rem; letter-spacing: -0.02em; }
        .nav-links { display: flex; align-items: stretch; gap: 0; }
        nav a { color: #64748b; text-decoration: none; padding: 0 1rem; display: flex; align-items: center; font-size: 0.9rem; font-weight: 500; border-bottom: 2px solid transparent; transition: color 0.15s, border-color 0.15s; }
        nav a:hover { color: #1e293b; background: #f8fafc; }
        nav a.active { color: #2563eb; border-bottom-color: #2563eb; font-weight: 600; }
        .nav-user { display: flex; align-items: center; gap: 0.75rem; }
        .nav-avatar { width: 34px; height: 34px; border-radius: 50%; background: linear-gradient(135deg, #2563eb, #7c3aed); display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 700; font-size: 0.8rem; flex-shrink: 0; }
        .nav-user-info { display: flex; flex-direction: column; line-height: 1.25; }
        .nav-user-name { font-size: 0.875rem; font-weight: 600; color: #1e293b; }
        .nav-user-role { font-size: 0.7rem; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; }

        /* Main */
        main { padding: 2.5rem 0; }

        /* Cards */
        .card { background: #fff; border-radius: 0.75rem; box-shadow: 0 1px 3px rgba(0,0,0,0.07), 0 1px 8px rgba(0,0,0,0.04); padding: 1.75rem; margin-bottom: 1.25rem; border: 1px solid #f1f5f9; }
        .card-header { display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1.25rem; padding-bottom: 1rem; border-bottom: 1px solid #f1f5f9; }
        .card-title { font-size: 1.1rem; font-weight: 700; color: #0f172a; margin: 0; }
        .card-subtitle { font-size: 0.8rem; color: #94a3b8; margin: 0.15rem 0 0; }
        .page-header { margin-bottom: 1.5rem; }
        .page-header h1 { font-size: 1.6rem; font-weight: 700; color: #0f172a; margin: 0 0 0.25rem; }
        .page-header p { color: #64748b; margin: 0; font-size: 0.95rem; }

        /* Stats */
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1rem; margin-bottom: 1.25rem; }
        .stat-card { background: #fff; border-radius: 0.75rem; padding: 1.25rem 1.5rem; border: 1px solid #f1f5f9; box-shadow: 0 1px 3px rgba(0,0,0,0.06); }
        .stat-label { font-size: 0.75rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 0.4rem; }
        .stat-value { font-size: 1.5rem; font-weight: 700; color: #0f172a; }
        .stat-value.blue { color: #2563eb; }
        .stat-value.green { color: #059669; }
        .stat-value.purple { color: #7c3aed; }

        /* Badges */
        .badge { display: inline-flex; align-items: center; padding: 0.2rem 0.6rem; border-radius: 999px; font-size: 0.7rem; font-weight: 600; letter-spacing: 0.03em; text-transform: uppercase; }
        .badge-admin { background: #ede9fe; color: #6d28d9; }
        .badge-general { background: #e0f2fe; color: #0369a1; }
        .badge-active { background: #d1fae5; color: #065f46; }
        .badge-inactive { background: #fee2e2; color: #991b1b; }

        /* Profile info rows */
        .info-row { display: flex; align-items: flex-start; padding: 0.75rem 0; border-bottom: 1px solid #f8fafc; gap: 1rem; }
        .info-row:last-child { border-bottom: none; }
        .info-label { font-size: 0.8rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; width: 120px; flex-shrink: 0; padding-top: 0.1rem; }
        .info-value { font-size: 0.95rem; color: #1e293b; font-weight: 500; }

        /* Buttons */
        .btn { display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.5rem 1.1rem; border-radius: 0.5rem; font-weight: 600; text-decoration: none; border: none; cursor: pointer; font-size: 0.875rem; transition: background 0.15s, box-shadow 0.15s; }
        .btn-primary { background: #2563eb; color: #fff; box-shadow: 0 1px 3px rgba(37,99,235,0.3); }
        .btn-primary:hover { background: #1d4ed8; box-shadow: 0 2px 6px rgba(37,99,235,0.4); }
        .btn-secondary { background: #f1f5f9; color: #475569; border: 1px solid #e2e8f0; }
        .btn-secondary:hover { background: #e2e8f0; }
        .btn-sm { padding: 0.35rem 0.75rem; font-size: 0.8rem; }

        /* Forms */
        .form-group { margin-bottom: 1.25rem; }
        .form-group label { display: block; margin-bottom: 0.35rem; font-weight: 600; font-size: 0.85rem; color: #374151; }
        .form-group input { width: 100%; padding: 0.6rem 0.85rem; border: 1.5px solid #e2e8f0; border-radius: 0.5rem; font-size: 0.95rem; font-family: inherit; background: #fafbfc; transition: border-color 0.15s, box-shadow 0.15s; }
        .form-group input:focus { outline: none; border-color: #2563eb; box-shadow: 0 0 0 3px rgba(37,99,235,0.12); background: #fff; }
        .error { color: #dc2626; font-size: 0.82rem; margin-top: 0.3rem; display: flex; align-items: center; gap: 0.25rem; }

        /* Alerts */
        .alert-success { background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; border-radius: 0.5rem; padding: 0.875rem 1rem; margin-bottom: 1rem; font-size: 0.9rem; }

        /* Utils */
        .flex { display: flex; }
        .gap-4 { gap: 1rem; }
        .items-center { align-items: center; }
        .text-muted { color: #94a3b8; font-size: 0.875rem; }
        .mt-1 { margin-top: 0.25rem; }
        .mt-2 { margin-top: 0.5rem; }
    </style>
</head>
<body>
    @auth
    <nav>
        <div class="container">
            <div class="flex items-center">
                <span class="nav-brand">⚡ AppName</span>
                <div class="nav-links">
                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
                    <a href="{{ route('profile') }}" class="{{ request()->routeIs('profile') ? 'active' : '' }}">Profile</a>
                    <a href="{{ route('settings') }}" class="{{ request()->routeIs('settings') ? 'active' : '' }}">Settings</a>
                </div>
            </div>
            <div class="nav-user">
                <div class="nav-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                <div class="nav-user-info">
                    <span class="nav-user-name">{{ auth()->user()->name }}</span>
                    <span class="nav-user-role">{{ auth()->user()->role }}</span>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-secondary btn-sm">Log out</button>
                </form>
            </div>
        </div>
    </nav>
    @endauth
    @auth
        @if(!auth()->user()->onboarding_completed_at)
            @include('onboarding.partial')
        @endif
    @endauth
    <main>
        <div class="container">
            @if(session('status'))
                <div class="alert-success">{{ session('status') }}</div>
            @endif
            @yield('content')
        </div>
    </main>
</body>
</html>
