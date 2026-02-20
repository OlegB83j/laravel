@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="card">
    <h1 style="margin: 0 0 0.5rem;">Dashboard</h1>
    <p style="color: #64748b; margin: 0;">Welcome back, {{ auth()->user()->name }}.</p>
</div>
<div class="card">
    <h2 style="margin: 0 0 1rem; font-size: 1.125rem;">Quick info</h2>
    <p>Role: <strong>{{ auth()->user()->role }}</strong></p>
    <p>Email: {{ auth()->user()->email }}</p>
    @if(auth()->user()->job_title)
        <p>Job title: {{ auth()->user()->job_title }}</p>
    @endif
</div>
@endsection
