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
                <a class="navbar-brand" href="#">Hidden brand</a>
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
            <li class="nav-item selected">
                <a id="headingArticles" data-toggle="collapse" data-target="#collapseArticles" aria-expanded="true" aria-controls="collapseArticles" class="nav-link text-light" href="#">@lang('admin/navbar.title_posts')</a>
                <ul id="collapseArticles" class="collapse show list-group nav subnav" aria-labbeledby="headingArticles" data-parent="#left_nav">
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
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="#">@lang('admin/navbar.title_users')</a>
            </li>
        </nav>

        <!-- <div class="container-fluid">
            <div class="row">
                <div class="col-3 col-sm-2 col-md-2 col-lg-1 col-xl-1">
                    <nav class="nav navbar-light navbar-toggleable-sm">
                        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarWEX" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="navbar-collapse collapse flex-column mt-md-0 mt-4 pt-md-0 pt-4" id="navbarWEX">
                            <a class="nav-link navbar-brand active" href="~/Views/Forms/ControlPanel.cshtml"><span class="fa fa-home"></span></a>
                            <a href="" class="nav-link">Linnk</a>
                            <a href="" class="nav-link">Linnk</a>
                            <a href="" class="nav-link">Linnk</a>
                        </div>
                    </nav>
                </div>
                <div class="col-9 col-sm-10 col-md-10 col-lg-11 col-xl-11">
                    <h2>Hello There</h2>
                </div>
            </div>
        </div> -->

        <div class="col-md-11 offset-md-1">
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
