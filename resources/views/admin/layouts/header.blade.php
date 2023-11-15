@php
    $admin = Auth::guard('admin')->user();
@endphp
@if ($admin)
    <header>
        <div class="admin-header">
            <div class="left">
                <a class="dashboard-link" href="{{route('dashboard')}}">Dashboard</a>
            </div>
            <div class="right">
                <span>Hello, {{ $admin->name }}</span>
                <i class="fa-solid fa-caret-down"></i>
                <a class="logout-btn" href="{{ route('admin.logout') }}">Logout</a>
            </div>
        </div>
    </header>
@endif