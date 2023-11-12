<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css"/>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Styles -->
    <link href="{{ asset('css/font-definitions.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- wysiwyg --}}
    <script src="https://cdn.tiny.cloud/1/q50oc5verflqnyvf6bi6py4cgqivi56zk5w6dqe2bon0wsrb/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>

    <script src="{{ asset('js/tinymce-config.js') }}"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/validation.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/pokemon-page.js') }}"></script>
</head>
<body>
    @php
        use Carbon\Carbon;
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $notifications = DB::table('notifications')
                ->where('data->noti_to', $user_id)
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get();

                foreach ($notifications as $notification) {
                    $notificationData = DB::table('notifications')->find($notification->id);
                    $notification->timeAgo = Carbon::parse($notificationData->created_at)->diffForHumans();
                }

            $unreadNotifications = $notifications->filter(function ($notification) {
                return is_null($notification->read_at);
            });

        } else {
            $notifications = [];
        }
    @endphp
    <div class="basic-theme" id="app">
        <nav class="navbar-container bg-white shadow-sm">
            <div class="main-navbar section-container">
                <a class="home-link" href="{{ url('/') }}">
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
                <div class="navbar-controll">
                    <form class="search-bar" action="{{ route('searchPokemon') }}" method="POST">
                        @csrf
                        <input class="input-border search-pokemon" type="text" placeholder="search pokemon..." name="searchString">
                        <i class="fa-brands fa-searchengin"></i>
                        <div class="search-results"></div>
                    </form>
                    <div class="nav-item dropdown dropdown-notifications">
                        <a class="notification-box" href="/market">
                            @if (isset($unreadNotifications) && count($unreadNotifications) > 0)
                                <span class='new-notification'>!</span>
                            @endif
                            <i class="fa-regular fa-bell" style="font-size: 21px;"></i>
                        </a>
                    </div>
                    <div class="menu-notification" aria-labelledby="navbarDropdown">
                        <p class="noti-label">Notification</p>
                        <div class="notifications-list">
                            @foreach ($notifications as $notification)
                                @php
                                    $data = json_decode($notification->data);
                                @endphp
                                <a class="noti-item @if(!$notification->read_at) noti-unread @endif" data-id={{$notification->id}} @if(isset($data->merchandise_id)) href="{{route('merchandise',['id' => $data->merchandise_id])}}#comment-{{$data->comment_id}}" @else href="{{route('post',['id' => $data->post_id])}}#comment-{{$data->comment_id}}" @endif>
                                    @if (isset($data->comment) && isset($data->title))
                                        <p>{{$data->title}}
                                            @if (isset($data->comment))
                                                <small>{{ $data->comment }}</small>
                                            @endif
                                        </p>
                                        <p><small class="sub-text">{{$notification->timeAgo}}</small></p>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <button class="mobile-navbar mobile">
                        <i class="fa-solid fa-bars" style="color: #131313; font-size: 21px;"></i>
                    </button>

                    <div class="desktop-navbar desktop">

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ms-auto nav-right desktop">
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

                        </ul>
                    </div>
                </div>
            </div>
            <div class="mobile-nav-links">
                <ul class="section-container">
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
                        <li class="mobile-nav-link">
                            <a class="thumbnail-avatar" href="#">
                                @if (Auth::user()->avatar)
                                    <img src="{{ Auth::user()->avatar }}" alt="">
                                @endif
                            </a>
                            <i class="fa-solid fa-caret-down" style="color: #131313;"></i>
                            <ul class="sub-links">
                                <a class="dropdown-item" href="{{ route('user.my-store') }}">My store</a>
                                <a class="dropdown-item" href="{{ route('user') }}">My account</a>
                            </ul>
                        </li>

                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    @endguest
                </ul>
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
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
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
                var current_url = $(location).attr('href');
                if (data.merchandise_id) {
                    var newUrlNotification = `/merchandise/${data.merchandise_id}`;
                }else{
                    var newUrlNotification = `/post/${data.post_id}`;
                }
                var newNotificationHtml;
                if(current_url.includes(newUrlNotification)) {
                    newNotificationHtml = `
                        <a class="noti-item noti-unread in-page" href="javascript:void(0)" onclick="handleUnreadNoti(${data.comment_id})" data-id=${data.id}>
                            <p>${data.title}
                                <small>${data.comment}</small>
                            </p>
                        </a>
                        `;
                }else {
                    newNotificationHtml = `
                        <a class="noti-item noti-unread" href="${newUrlNotification}#comment-${data.comment_id}" data-id=${data.id}>
                            <p>${data.title}
                                <small>${data.comment}</small>
                            </p>
                        </a>
                        `;
                }

                var newNotilabel = "<span class='new-notification'>!</span>";
                $('.notifications-list').prepend(newNotificationHtml);
                $('.notification-box').prepend(newNotilabel);
            });
            function handleUnreadNoti(comment_id) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    success: function(response) {
                        $(".comment-place").html($(response).find(".comment-place").html())
                        $(`#comment-${comment_id}`).addClass('highlight-background');
                        setTimeout(function() {
                            $(`#comment-${comment_id}`).removeClass('highlight-background');
                        }, 5000);
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            }
        @endif

    </script>
</body>
</html>
