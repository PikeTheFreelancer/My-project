<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="INDEX,FOLLOW">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta property="og:site_name" content="{{ config('app.name', 'Vermilion Center') }}">
    <meta property="og:title" content="{{ config('app.name', 'Vermilion Center') }}">
    <meta property="og:url" content="{{Request::url()}}">
    <meta name="twitter:title" content="{{ config('app.name', 'Vermilion Center') }}">
    <meta itemprop="name" content="{{ config('app.name', 'Vermilion Center') }}">
    <meta property="og:image" content="{{asset('images/pages/vermilioncity.webp')}}">
    <meta property="og:description" content="{!!__('messages.meta.desc')!!}">
    <meta name="twitter:description" content="{!!__('messages.meta.desc')!!}">
    <meta itemprop="description" content="{!!__('messages.meta.desc')!!}">
    <link rel="canonical" href="{{Request::url()}}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/pages/favicon.webp') }}">
    <meta name="description" content="{!!__('messages.meta.desc')!!}">
    @if (Request::path() == '/')
        <title>{{ config('app.name', 'Vermilion Center') }}</title>
    @else
        <title>{{ config('app.name', 'Vermilion Center') }} - {{ucfirst(Request::path())}}</title>
    @endif
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css" /> --}}
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css"/>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Styles -->
    <link href="{{ asset('css/font-definitions.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- wysiwyg --}}
    <script src="https://cdn.tiny.cloud/1/q50oc5verflqnyvf6bi6py4cgqivi56zk5w6dqe2bon0wsrb/tinymce/6/tinymce.min.js" referrerpolicy="origin" defer></script>
    
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" defer></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js" defer></script>
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous" defer></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js" defer></script>
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <script src="{{ asset('js/tinymce-config.js') }}" defer></script>
    <script src="{{ asset('js/validation.js') }}" defer></script>
    <script src="{{ asset('js/custom.js') }}" defer></script>
    <script src="{{ asset('js/pokemon-page.js') }}" defer></script>
</head>
<body>
    @php
        use Carbon\Carbon;
        use App\Models\Boss;

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

        $kanto_bosses = Boss::where('region', 'kanto')->get();
        $johto_bosses = Boss::where('region', 'johto')->get();
        $hoenn_bosses = Boss::where('region', 'hoenn')->get();
        $sinnoh_bosses = Boss::where('region', 'sinnoh')->get();
    @endphp
    <div class="basic-theme" id="app">
        <nav class="navbar-container bg-white shadow-sm">
            <div class="nav-bar-container">
            <div class="main-navbar space-between header-container">
                <div class="navbar-left">
                    <a class="home-link" href="{{ url('/') }}">
                        <div class="pokeball">
                            <div class="half-pokeball half-top">
                                @include('svg.half-top')
                            </div>
                            <span class="ball-text">{{__('messages.header.home')}}</span>
                            <div class="half-pokeball half-bottom">
                                @include('svg.half-bottom')
                            </div>
                        </div>
                    </a>
                    <ul>
                        <li>
                            <a class="nav-link-text desktop" href="{{route('newsfeed')}}">
                                {{ __('community.newsfeed') }}
                            </a>
                        </li>
                        <li class="bosses">
                            <a class="nav-link-text desktop" href="#">
                                Bosses
                            </a>
                            @include('user.components.bosses-menu')
                            
                        </li>
                    </ul>
                </div>
                <div class="navbar-controll">
                    <form class="search-bar" action="{{ route('searchPokemon') }}" method="POST">
                        @csrf
                        <input class="input-border search-pokemon" type="text" placeholder="{{__('messages.header.search_holder')}}" name="searchString">
                        <i class="fa-brands fa-searchengin"></i>
                        <div class="search-results"></div>
                    </form>
                    <div class="search-bar-mobile">
                        <i class="fa-brands fa-searchengin"></i>
                    </div>
                    <div class="lang">
                        @if (Session::get('language'))
                            <span>{{ Session::get('language') }}</span>
                        @else
                            <span>En</span>
                        @endif
                        <i class="fa-solid fa-caret-down"></i>
                        <ul class="lang-items">
                            <li><a href="{{route('change-language', 'en')}}">En</a></li>
                            <li><a href="{{route('change-language', 'vi')}}">Vi</a></li>
                        </ul>
                    </div>
                    <div class="nav-item dropdown dropdown-notifications">
                        <a class="notification-box" href="#">
                            <span class="hidden">notification</span>
                            @if (isset($unreadNotifications) && count($unreadNotifications) > 0)
                                <span class='new-notification'>!</span>
                            @endif
                            <i class="fa-regular fa-bell" style="font-size: 21px;"></i>
                        </a>
                    </div>
                    <div class="menu-notification" aria-labelledby="navbarDropdown">
                        <p class="noti-label">{{ __('messages.header.notifications') }}</p>
                        <div class="notifications-list">
                            @foreach ($notifications as $notification)
                                @php
                                    $data = json_decode($notification->data);
                                    $abc = 'Merchandise';
                                @endphp
                                <a class="noti-item @if(!$notification->read_at) noti-unread @endif" data-id={{$notification->id}} @if(isset($data->merchandise_id)) href="{{route('merchandise',['id' => $data->merchandise_id])}}#comment-{{$data->comment_id}}" @else href="{{route('post',['id' => $data->post_id])}}#comment-{{$data->comment_id}}" @endif>
                                    @if (isset($data->comment) && isset($data->title))
                                        <p>{{$data->noti_from}} {{__($data->title)}}:
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
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('messages.header.login') }}</a>
                                    </li>
                                @endif

                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('messages.header.register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item">
                                    <a class="thumbnail-avatar" href="#">
                                        @if (Auth::user()->avatar)
                                            <img src="{{ Auth::user()->avatar }}" alt="avatar">
                                        @else
                                            <img src="{{asset('images/pages/Unknown_person.webp')}}" alt="Unknown_person.webp">
                                        @endif
                                    </a>

                                    <div class="dropdown-actions">
                                        <a class="dropdown-item" href="{{ route('user') }}">{{ __('messages.header.account') }}</a>

                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('messages.header.logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>

                                    </div>
                                </li>
                            @endguest

                        </ul>
                    </div>
                </div>
            </div>
            <div class="mobile-nav-links shadow-sm">
                <ul class="header-container">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('newsfeed')}}">
                            {{ __('community.newsfeed') }}
                        </a>
                    </li>
                    <li class="nav-item mobile-nav-link">
                        <div class="mobile-nav-link">
                            {{ __('Bosses') }}
                            <i class="fa-solid fa-caret-down" style="color: #131313;"></i>
                        </div>
                        @include('user.components.bosses-menu-mobile')
                    </li>
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('messages.header.login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('messages.header.register') }}</a>
                            </li>
                        @endif
                    @else
                        <li>
                            <div class="mobile-nav-link">
                                <a class="thumbnail-avatar" href="#">
                                    @if (Auth::user()->avatar)
                                        <img src="{{ Auth::user()->avatar }}" alt="avatar">
                                    @endif
                                </a>
                                <i class="fa-solid fa-caret-down" style="color: #131313;"></i>
                            </div>
                            <ul class="sub-links">
                                <a class="dropdown-item" href="{{ route('user') }}">{{ __('messages.header.account') }}</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    {{ __('messages.header.logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
            <form class="search-form-mobile shadow-sm" action="{{ route('searchPokemon') }}" method="POST">
                @csrf
                <input class="input-border search-pokemon" type="text" placeholder="{{ __('messages.header.search_holder') }}" name="searchString">
                <div class="search-results"></div>
            </form>
        </div>
        </nav>

        <main class="content-container">
            @yield('banner')
            @yield('content')
        </main>

        @include('layouts.footer')
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
                            <p>${data.noti_from} ${data.title}:
                                <small>${data.comment}</small>
                            </p>
                        </a>
                        `;
                }else {
                    newNotificationHtml = `
                        <a class="noti-item noti-unread" href="${newUrlNotification}#comment-${data.comment_id}" data-id=${data.id}>
                            <p>${data.noti_from} ${data.title}:
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
