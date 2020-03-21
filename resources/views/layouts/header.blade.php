<header class="app-header navbar">
    {{--<button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">☰</button>--}}
    <a class="navbar-brand" href="/">Questionnaire</a>
    {{--<button class="navbar-toggler sidebar-minimizer d-md-down-none" type="button">☰</button>--}}

    <ul class="nav navbar-nav d-md-down-none">

        <li class="nav-item px-3">
            <a class="nav-link" href="{{ route('topics.index') }}">Topics</a>
        </li>

    </ul>

    <ul class="nav navbar-nav ml-auto">
        <li class="nav-item dropdown" id="name-display">
            <a style="padding-right: 1rem;" class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#"
               role="button" aria-haspopup="true" aria-expanded="false">
                <span class="d-md-down-none"><strong>{{Auth::guard('web')->user()->name}}</strong></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <form method='POST' action='{{route("logout")}}'>
                    {{csrf_field()}}
                    <button class="dropdown-item"><i class="fa fa-lock"></i> Logout</button>
                </form>
            </div>
        </li>
    </ul>
    {{--<button class="navbar-toggler aside-menu-toggler" type="button">☰</button>--}}
</header>
