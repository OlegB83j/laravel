@extends('layouts.app')

@section('title', 'Log in')

@section('content')
<div style="min-height: 70vh; display: flex; align-items: center; justify-content: center;">
    <div style="width: 100%; max-width: 22rem;">
        <div style="text-align: center; margin-bottom: 2rem;">
            <div style="width: 52px; height: 52px; border-radius: 50%; background: linear-gradient(135deg, #2563eb, #7c3aed); display: inline-flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                <span style="color:#fff; font-size:1.4rem;">⚡</span>
            </div>
            <h1 style="margin: 0 0 0.25rem; font-size: 1.5rem; font-weight: 700; color: #0f172a;">Welcome back</h1>
            <p style="margin: 0; color: #64748b; font-size: 0.9rem;">Sign in to your account</p>
        </div>

        <div class="card" style="padding: 2rem;">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="email" placeholder="you@example.com">
                    @error('email')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="••••••••">
                    @error('password')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group" style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1.5rem;">
                    <input id="remember" type="checkbox" name="remember" style="width:auto; accent-color:#2563eb;">
                    <label for="remember" style="margin: 0; font-size: 0.875rem; color: #475569; font-weight: 500;">Remember me</label>
                </div>
                <button type="submit" class="btn btn-primary" style="width:100%; justify-content:center; padding: 0.65rem 1rem; font-size: 0.95rem;">Sign in</button>
            </form>
        </div>

        <div style="margin-top: 1.25rem; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 0.5rem; padding: 0.875rem 1rem; font-size: 0.8rem; color: #64748b; line-height: 1.6;">
            <strong style="color:#475569;">Test accounts</strong> (password: <code style="background:#e2e8f0; padding:0.1rem 0.3rem; border-radius:3px;">password</code>)<br>
            admin1@example.com, admin2@example.com<br>
            user1@example.com … user8@example.com
        </div>
    </div>
</div>
@endsection
