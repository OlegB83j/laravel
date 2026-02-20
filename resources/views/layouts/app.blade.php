<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name'))</title>
    <style>
        @import url('https://fonts.bunny.net/css?family=figtree:400,600,700&display=swap');
        * { box-sizing: border-box; }
        body { font-family: 'Figtree', sans-serif; margin: 0; min-height: 100vh; background: #f8fafc; color: #1e293b; }
        .container { max-width: 960px; margin: 0 auto; padding: 0 1rem; }
        nav { background: #fff; border-bottom: 1px solid #e2e8f0; padding: 0.75rem 0; }
        nav .container { display: flex; align-items: center; justify-content: space-between; }
        nav a { color: #475569; text-decoration: none; padding: 0.5rem 0.75rem; border-radius: 0.375rem; }
        nav a:hover { color: #0f172a; background: #f1f5f9; }
        nav a.active { color: #0f172a; font-weight: 600; }
        main { padding: 2rem 0; }
        .card { background: #fff; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.08); padding: 1.5rem; margin-bottom: 1rem; }
        .btn { display: inline-block; padding: 0.5rem 1rem; border-radius: 0.375rem; font-weight: 600; text-decoration: none; border: none; cursor: pointer; font-size: 0.875rem; }
        .btn-primary { background: #2563eb; color: #fff; }
        .btn-primary:hover { background: #1d4ed8; }
        .btn-secondary { background: #e2e8f0; color: #475569; }
        .btn-secondary:hover { background: #cbd5e1; }
        .form-group { margin-bottom: 1rem; }
        .form-group label { display: block; margin-bottom: 0.25rem; font-weight: 500; }
        .form-group input { width: 100%; padding: 0.5rem 0.75rem; border: 1px solid #cbd5e1; border-radius: 0.375rem; font-size: 1rem; }
        .form-group input:focus { outline: none; border-color: #2563eb; box-shadow: 0 0 0 3px rgba(37,99,235,0.15); }
        .error { color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem; }
        .flex { display: flex; }
        .gap-4 { gap: 1rem; }
        .items-center { align-items: center; }
    </style>
</head>
<body>
    @auth
    <nav>
        <div class="container">
            <div class="flex gap-4 items-center">
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
                <a href="{{ route('profile') }}" class="{{ request()->routeIs('profile') ? 'active' : '' }}">Profile</a>
                <a href="{{ route('settings') }}" class="{{ request()->routeIs('settings') ? 'active' : '' }}">Settings</a>
            </div>
            <div class="flex gap-4 items-center">
                <span class="text-sm text-slate-500">{{ auth()->user()->name }} ({{ auth()->user()->role }})</span>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="btn btn-secondary">Log out</button>
                </form>
            </div>
        </div>
    </nav>
    @endauth
    <main>
        <div class="container">
            @if(session('status'))
                <div class="card" style="background: #ecfdf5; color: #065f46;">{{ session('status') }}</div>
            @endif
            @yield('content')
        </div>
    </main>
</body>
</html>
