<header class="c-header c-header-light c-sticky-top">
    <button class="c-header-toggler c-class-toggler ml-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true"><span class="c-header-toggler-icon"></span></button>

<?php
    use App\MenuBuilder\FreelyPositionedMenus;
    if(isset($appMenus['top menu'])){
        FreelyPositionedMenus::render( $appMenus['top menu'] , 'c-header-', 'd-md-down-none');
    }
    ?>
    <div class="c-header-brand mb-0 h3" href="#">Covid</div>
    <ul class="c-header-nav ml-auto mr-4">

        <li class="c-header-nav-item dropdown">
            <a style="padding-right: 1rem;" class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#"
               role="button" aria-haspopup="true" aria-expanded="false">
                <span class="d-md-down-none mb-0 h3"><strong>{{Auth::guard('web')->user()->name}}</strong></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right pt-0">
                <div class="dropdown-header bg-light py-2"><strong>Account</strong></div>
                <form method='POST' action='{{route("logout")}}'>
                    {{csrf_field()}}
                    <button class="dropdown-item"><i class="fa fa-lock"></i> Logout</button>
                </form>
            </div>
        </li>
    </ul>

</header>
