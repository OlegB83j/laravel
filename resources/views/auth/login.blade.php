@extends('layouts.app')

@section('title', 'Log in')

@section('content')
<div class="card" style="max-width: 24rem; margin: 2rem auto;">
    <h1 style="margin: 0 0 1.5rem; font-size: 1.5rem;">Log in</h1>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="email">
            @error('email')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password">
            @error('password')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group" style="display: flex; align-items: center; gap: 0.5rem;">
            <input id="remember" type="checkbox" name="remember">
            <label for="remember" style="margin: 0;">Remember me</label>
        </div>
        <button type="submit" class="btn btn-primary">Log in</button>
    </form>
    <p style="margin-top: 1rem; font-size: 0.875rem; color: #64748b;">
        Test users: admin1@example.com, admin2@example.com, user1@example.com … user8@example.com (password: <code>password</code>)
    </p>
</div>
@endsection
