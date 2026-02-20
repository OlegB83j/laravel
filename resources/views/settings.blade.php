@extends('layouts.app')

@section('title', 'Settings')

@section('content')
<div class="page-header">
    <h1>Settings</h1>
    <p>Manage your account preferences and configuration.</p>
</div>

<div class="card">
    <div class="card-header">
        <div>
            <div class="card-title">Account</div>
            <div class="card-subtitle">Your login and identity details</div>
        </div>
    </div>
    <div class="info-row">
        <span class="info-label">Logged in as</span>
        <span class="info-value">{{ auth()->user()->email }}</span>
    </div>
    <div class="info-row">
        <span class="info-label">Role</span>
        <span class="info-value">
            <span class="badge {{ auth()->user()->role === 'admin' ? 'badge-admin' : 'badge-general' }}">
                {{ auth()->user()->role }}
            </span>
        </span>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div>
            <div class="card-title">Preferences</div>
            <div class="card-subtitle">Application settings coming soon</div>
        </div>
    </div>
    <p class="text-muted" style="margin:0;">No configurable preferences yet. Check back later.</p>
</div>
@endsection
