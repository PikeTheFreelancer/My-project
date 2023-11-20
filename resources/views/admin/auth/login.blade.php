<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">
    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-definitions.css') }}" rel="stylesheet">

    {{-- script --}}
    <script src="{{ asset('js/admin.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/custom.js') }}"></script>

</head>
<body>
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
</body>
</html>