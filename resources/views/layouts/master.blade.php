<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Questionnaire System</title>

        <link href="{{mix('css/app.css')}}" rel="stylesheet">
        <link href="{{asset('css/free.min.css')}}" rel="stylesheet">
        @section('css')
        @show
        @section('style')
        @show
        <script>
            window.Laravel = {!! json_encode([
                        'csrfToken' => csrf_token(),
                ]) !!}
                @if (session('_SUCCESS'))
            var _SUCCESS = {!!json_encode(session('_SUCCESS'))!!}
                @endif
                @if (session('_WARNING'))
            var _WARNING = {!!json_encode(session('_WARNING'))!!}
            @endif
        </script>
    </head>

    <body class="c-app">
{{--        <div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">--}}

{{--            @include('layouts.nav-builder')--}}

{{--            @include('layouts.header')--}}

{{--            <div class="c-body">--}}

{{--                <main class="c-main">--}}

{{--                    @yield('content')--}}

{{--                </main>--}}
{{--            </div>--}}
{{--            @include('layouts.footer')--}}
{{--        </div>--}}
        @include('layouts.sidebar')
        <div class="c-wrapper">
            @include('layouts.header')

            <div class="c-body">
                <main class="c-main">
                    @yield('content')
                </main>
            </div>
            @include('layouts.footer')
        </div>


    <!-- CoreUI and necessary plugins-->
    <script src="{{ asset('js/pace.min.js') }}"></script>
    <script src="{{ asset('js/coreui.bundle.min.js') }}"></script>
    <script src="{{ asset('js/coreui-utils.js') }}"></script>=

    @yield('javascript')




    </body>
</html>
