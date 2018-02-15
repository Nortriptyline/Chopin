<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-dark cs-bg-dark fixed-top">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <h1><a class="navbar-brand" href="#">{{ config('app.name', 'Laravel') }}</a></h1>
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <!-- <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link disabled" href="#">Disabled</a>
                    </li> -->
                </ul>
            </div>
        </nav>

        <nav id="left_nav" class="nav-left nav flex-column fixed-top cs-bg-dark col-1">

            <li class="nav-item @selected(admin/posts) @selected(admin)">
                <a class="nav-link text-light" href="{{ route('admin.') }}">@lang('admin/navbar.title_posts')</a>
                @if(Request::is('admin/posts*') || Request::is('admin'))
                    <ul class="list-group nav subnav">
                        <li class="nav-item">
                            <a href="" class="nav-link">@lang('admin/navbar.subtitle_all_posts')</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">@lang('admin/navbar.subtitle_add_posts')</a>
                        </li>
                        <li class="nav-item selected">
                            <a href="" class="nav-link">@lang('admin/navbar.subtitle_categories')</a>
                        </li>
                    </ul>
                @endif
            </li>

            @can('index', App\User::class)
                <li class="nav-item @selected(admin/users*)">
                    <a class="nav-link text-light" href="{{ route('admin.users.index') }}">@lang('admin/navbar.title_users')</a>
                    @if(Request::is('admin/users*'))
                        <ul class="list-group nav subnav">
                            <li class="nav-item @selected(admin/users)">
                                <a href="{{ route('admin.users.index') }}" class="nav-link">@lang('admin/navbar.subtitle_all_users')</a>
                            </li>
                            <li class="nav-item @selected(admin/users/create)">
                                <a href="{{ route('admin.users.create') }}" class="nav-link">@lang('admin/navbar.subtitle_add_users')</a>
                            </li>
                            <li class="nav-item @selected(admin/users/roles)">
                                <a href="{{ route('admin.roles.index') }}" class="nav-link">@lang('admin/navbar.subtitle_roles')</a>
                            </li>
                        </ul>
                    @endif
                </li>
            @endcan
        </nav>

        <main class="col-md-11 offset-md-1 admin_content">
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
