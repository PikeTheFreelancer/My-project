@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="admin-dashboard">
        <h2>Hello, {{ $admin->name }}</h2>
        <a href="{{ route('admin.logout') }}">Logout</a>
    </div>
@endsection