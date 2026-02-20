@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="card">
    <h1 style="margin: 0 0 1rem;">Your profile</h1>
    <p><strong>Name:</strong> {{ auth()->user()->name }}</p>
    <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
    <p><strong>Role:</strong> {{ auth()->user()->role }}</p>
    <p><strong>Phone:</strong> {{ auth()->user()->phone ?? '—' }}</p>
    <p><strong>Job title:</strong> {{ auth()->user()->job_title ?? '—' }}</p>
    <p><strong>Active:</strong> {{ auth()->user()->is_active ? 'Yes' : 'No' }}</p>
</div>
@endsection
