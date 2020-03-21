<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Questionnaire System</title>

    <link href="{{mix('css/app.css')}}" rel="stylesheet">

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
<body class="app header-fixed">
@include('layouts.header')

<div class="app-body">
    <div class="main">

        @section('content')

        @show
    </div>
</div>

<footer class="app-footer">
    <div>
        <a href="https://coreui.io">CoreUI</a>
        <span>&copy; 2018 creativeLabs.</span>
    </div>
    <div class="ml-auto">
        <span>Powered by</span>
        <a href="https://coreui.io">CoreUI</a>
    </div>
</footer>

<!-- GenesisUI main scripts -->
<script src="{{mix('js/app.js')}}"></script>
@section('js')
@show

<script>
    @if (count($errors) > 0)
    @foreach($errors-> all() as $error)
    new PNotify({
        title: 'Error!',
        text: '{{ $error }}',
        type: 'error'
    });
    @endforeach
    @endif
</script>

@section('script')
@show

</body>
</html>
