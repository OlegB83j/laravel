@extends('layouts.app')

@section('title', 'Log in')

@section('content')
<div style="min-height: 75vh; display: flex; align-items: center; justify-content: center;">
    <div style="width: 100%; max-width: 26rem;">

        <div style="text-align: center; margin-bottom: 2.5rem;">
            <div style="width: 60px; height: 60px; border-radius: 16px; background: linear-gradient(135deg, #2563eb, #7c3aed); display: inline-flex; align-items: center; justify-content: center; margin-bottom: 1.25rem; box-shadow: 0 4px 14px rgba(37,99,235,0.35);">
                <span style="color:#fff; font-size:1.6rem;">⚡</span>
            </div>
            <h1 style="margin: 0 0 0.4rem; font-size: 1.75rem; font-weight: 700; color: #0f172a; letter-spacing: -0.02em;">Welcome back</h1>
            <p style="margin: 0; color: #64748b; font-size: 0.95rem;">Sign in to continue to your account</p>
        </div>

        <div class="card" style="padding: 2.25rem; border-radius: 1rem; box-shadow: 0 4px 24px rgba(0,0,0,0.08);">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group" style="margin-bottom: 1.4rem;">
                    <label for="email" style="font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem; display: block;">Email address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="email" placeholder="you@example.com"
                        style="padding: 0.75rem 1rem; font-size: 1rem; border-radius: 0.6rem;">
                    @error('email')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group" style="margin-bottom: 1.25rem;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                        <label for="password" style="font-size: 0.875rem; font-weight: 600; color: #374151; margin: 0;">Password</label>
                    </div>
                    <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="Enter your password"
                        style="padding: 0.75rem 1rem; font-size: 1rem; border-radius: 0.6rem;">
                    @error('password')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div style="display: flex; align-items: center; gap: 0.6rem; margin-bottom: 1.75rem;">
                    <input id="remember" type="checkbox" name="remember" style="width: 16px; height: 16px; accent-color:#2563eb; cursor:pointer; flex-shrink:0;">
                    <label for="remember" style="margin: 0; font-size: 0.875rem; color: #475569; font-weight: 500; cursor:pointer;">Keep me signed in</label>
                </div>
                <button type="submit" class="btn btn-primary" style="width:100%; justify-content:center; padding: 0.8rem 1rem; font-size: 1rem; border-radius: 0.6rem; letter-spacing: 0.01em;">
                    Sign in →
                </button>
            </form>
        </div>

        <div style="margin-top: 1.5rem; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 0.75rem; padding: 1rem 1.25rem; font-size: 0.8rem; color: #64748b; line-height: 1.8;">
            <div style="font-weight: 700; color: #475569; margin-bottom: 0.25rem;">🔑 Test accounts</div>
            <div><strong style="color:#374151;">Admins:</strong> admin1@example.com, admin2@example.com</div>
            <div><strong style="color:#374151;">Users:</strong> user1@example.com … user8@example.com</div>
            <div style="margin-top: 0.35rem;">Password: <code style="background:#e2e8f0; padding:0.15rem 0.4rem; border-radius:4px; font-size:0.78rem;">password</code></div>
        </div>

    </div>
</div>
@endsection
