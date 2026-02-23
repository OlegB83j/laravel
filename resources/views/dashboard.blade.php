@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="page-header">
    <h1>Welcome back, {{ auth()->user()->name }} 👋</h1>
    <p>Here's an overview of your account.</p>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-label">Role</div>
        <div class="stat-value blue" style="font-size:1.1rem; margin-top:0.25rem;">
            <span class="badge {{ auth()->user()->role === 'admin' ? 'badge-admin' : 'badge-general' }}">
                {{ auth()->user()->role }}
            </span>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Status</div>
        <div class="stat-value" style="font-size:1.1rem; margin-top:0.25rem;">
            <span class="badge {{ auth()->user()->is_active ? 'badge-active' : 'badge-inactive' }}">
                {{ auth()->user()->is_active ? 'Active' : 'Inactive' }}
            </span>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Member since</div>
        <div class="stat-value" style="font-size:1rem; margin-top:0.25rem; color:#475569;">
            {{ auth()->user()->created_at->format('M Y') }}
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div>
            <div class="card-title">Account details</div>
            <div class="card-subtitle">Your profile information at a glance</div>
        </div>
    </div>
    <div class="info-row">
        <span class="info-label">Email</span>
        <span class="info-value">{{ auth()->user()->email }}</span>
    </div>
    @if(auth()->user()->phone)
    <div class="info-row">
        <span class="info-label">Phone</span>
        <span class="info-value">{{ auth()->user()->phone }}</span>
    </div>
    @endif
    @if(auth()->user()->job_title)
    <div class="info-row">
        <span class="info-label">Job title</span>
        <span class="info-value">{{ auth()->user()->job_title }}</span>
    </div>
    @endif
    <div class="info-row" style="border:none; padding-top:1rem;">
        <a href="{{ route('profile') }}" class="btn btn-primary btn-sm">View full profile</a>
        <a href="{{ route('settings') }}" class="btn btn-secondary btn-sm">Settings</a>
    </div>
</div>
@endsection
