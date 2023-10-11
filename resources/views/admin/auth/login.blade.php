@extends('admin.layouts.app')
@section('title', 'Admin Login')
<div class="admin-login">
    <img src="{{ asset('/images/admin/admin-bg.jpg') }}" alt="">
    <div class="admin-login-form">
        <form method="POST" action="{{ route('admin.login') }}">
            @csrf
            <h1>Admin</h1>
            <input type="text" name="email" placeholder="Nhập địa chỉ email">
            <input type="password" name="password" placeholder="Nhập mật khẩu">
            <button class="admin-login-btn" type="submit">
                <span>Login</span>
            </button>
        </form>
    </div>
</div>