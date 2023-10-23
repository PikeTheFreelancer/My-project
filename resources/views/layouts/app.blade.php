<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css"/>
    
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/font-definitions.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/custom.js') }}"></script>
</head>
<body>
    @php
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $notifications = DB::table('notifications')
                ->where('data->noti_to', $user_id)
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get();
            $unreadNotifications = $notifications->filter(function ($notification) {
                return is_null($notification->read_at);
            });

        } else {
            $notifications = [];
        }
    @endphp
    <div class="basic-theme" id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="section-container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <div class="pokeball">
                        <div class="half-pokeball half-top">
                            @include('svg.half-top')
                        </div>
                        <span class="ball-text">Home</span>
                        <div class="half-pokeball half-bottom">
                            @include('svg.half-bottom')
                        </div>
                    </div>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto nav-right">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown dropdown-notifications">
                                <a class="notification-box" href="/market">
                                    @if (count($unreadNotifications) > 0)
                                        <span class='new-notification'>!</span>
                                    @endif
                                    <i class="fa-regular fa-bell"></i>
                                </a>
                            </li>
                            
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="thumbnail-avatar" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    @if (Auth::user()->avatar)
                                        <img src="{{ Auth::user()->avatar }}" alt="">
                                    @endif
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>

                                    <a class="dropdown-item" href="{{ route('user.my-store') }}">My store</a>
                                    <a class="dropdown-item" href="{{ route('user') }}">My account</a>
                                </div>
                            </li>
                        @endguest
                        <div class="menu-notification" aria-labelledby="navbarDropdown">
                            <p class="noti-label">Notification</p>
                            <div class="notifications-list">
                                @foreach ($notifications as $notification)
                                    @php
                                        $data = json_decode($notification->data);
                                    @endphp
                                    <a class="dropdown-item noti-item @if(!$notification->read_at) noti-unread @endif" data-id={{$notification->id}} href="{{route('market')}}#comment-{{$data->comment_id}}">
                                        @if (isset($data->comment) && isset($data->title))
                                            <p>{{$data->title}}
                                                @if (isset($data->comment))
                                                    <small>{{ $data->comment }}</small>
                                                @endif
                                            </p>
                                        @endif
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @stack('js')
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://js.pusher.com/4.4/pusher.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script type="text/javascript">
        var pusher = new Pusher('{{ Config::get('broadcasting.connections.pusher.key') }}', {
            encrypted: true,
            cluster: "ap1"
        });
        @if (Auth::check()) 
            var recipant = {{ Auth::user()->id }};
            var channel = pusher.subscribe('CommentNotificationEvent');
            var message;
            channel.bind(recipant, function(data) {
                var newNotificationHtml = `
                <a class="dropdown-item noti-item noti-unread" href="{{route('market')}}#comment-${data.comment_id}" data-id=${data.id}>
                    <p>${data.title}
                        <small>${data.comment}</small>
                    </p>
                </a>
                `;
                var newNotilabel = "<span class='new-notification'>!</span>";
                $('.notifications-list').prepend(newNotificationHtml);
                $('.notification-box').prepend(newNotilabel);
            });
        @endif
    </script>
</body>
</html>
