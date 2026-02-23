@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="page-header">
    <h1>Your Profile</h1>
    <p>Personal information and account details.</p>
</div>

<div class="card">
    <div class="card-header">
        <div style="display:flex; align-items:center; gap:1rem;">
            <div style="width:52px; height:52px; border-radius:50%; background:linear-gradient(135deg,#2563eb,#7c3aed); display:flex; align-items:center; justify-content:center; color:#fff; font-weight:700; font-size:1.3rem; flex-shrink:0;">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div>
                <div class="card-title">{{ auth()->user()->name }}</div>
                <div class="card-subtitle">{{ auth()->user()->email }}</div>
            </div>
        </div>
        <span class="badge {{ auth()->user()->role === 'admin' ? 'badge-admin' : 'badge-general' }}">
            {{ auth()->user()->role }}
        </span>
    </div>

    <div class="info-row">
        <span class="info-label">Full name</span>
        <span class="info-value">{{ auth()->user()->name }}</span>
    </div>
    <div class="info-row">
        <span class="info-label">Email</span>
        <span class="info-value">{{ auth()->user()->email }}</span>
    </div>
    <div class="info-row">
        <span class="info-label">Phone</span>
        <span class="info-value">{{ auth()->user()->phone ?? '—' }}</span>
    </div>
    <div class="info-row">
        <span class="info-label">Job title</span>
        <span class="info-value">{{ auth()->user()->job_title ?? '—' }}</span>
    </div>
    <div class="info-row">
        <span class="info-label">Status</span>
        <span class="info-value">
            <span class="badge {{ auth()->user()->is_active ? 'badge-active' : 'badge-inactive' }}">
                {{ auth()->user()->is_active ? 'Active' : 'Inactive' }}
            </span>
        </span>
    </div>
    <div class="info-row">
        <span class="info-label">Member since</span>
        <span class="info-value">{{ auth()->user()->created_at->format('F j, Y') }}</span>
    </div>
</div>
@endsection
