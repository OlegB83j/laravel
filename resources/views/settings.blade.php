@extends('layouts.app')

@section('title', 'Settings')

@section('content')
<div class="card">
    <h1 style="margin: 0 0 1rem;">Settings</h1>
    <p>Application settings and preferences can go here.</p>
    <p style="color: #64748b; margin-top: 1rem;">You are logged in as <strong>{{ auth()->user()->email }}</strong>.</p>
</div>
@endsection
