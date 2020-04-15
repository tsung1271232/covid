<header class="c-header c-header-fixed">
    <button class="c-header-toggler c-class-toggler mb-0 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true"><span class="c-header-toggler-icon"></span></button>
    <?php
    use App\MenuBuilder\FreelyPositionedMenus;
    if(isset($appMenus['top menu'])){
        FreelyPositionedMenus::render( $appMenus['top menu'] , 'c-header-', 'd-md-down-none');
    }
    ?>
    <ul class="c-header-nav mr-auto">
        <div class="c-header-brand mb-0" href="#">Covid</div>
    </ul>

    <ul class="c-header-nav">
        <li class="c-header-nav-item dropdown">
            <a class="c-header-nav-link" data-toggle="dropdown" href="#"
               role="button" aria-haspopup="true" aria-expanded="true">
                <span class="d-md-down-none mb-0">{{ Auth::guard('web')->user()->name }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right pt-0">
                <div class="dropdown-header bg-light py-2"><strong>Action</strong></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="dropdown-item"> <i class="cil-account-logout mr-3"></i>Logout</button>
                </form>
            </div>
        </li>
    </ul>
</header>
