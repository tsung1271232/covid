{{--<?php--}}
{{--/*--}}
{{--    $data = $menuel['elements']--}}
{{--*/--}}

{{--if(!function_exists('renderDropdown')){--}}
{{--    function renderDropdown($data){--}}
{{--        if(array_key_exists('slug', $data) && $data['slug'] === 'dropdown'){--}}
{{--            echo '<li class="c-sidebar-nav-dropdown">';--}}
{{--            echo '<a class="c-sidebar-nav-dropdown-toggle" href="#">';--}}
{{--            if($data['hasIcon'] === true && $data['iconType'] === 'coreui'){--}}
{{--                echo '<i class="' . $data['icon'] . ' c-sidebar-nav-icon"></i>';--}}
{{--            }--}}
{{--            echo $data['name'] . '</a>';--}}
{{--            echo '<ul class="c-sidebar-nav-dropdown-items">';--}}
{{--            renderDropdown( $data['elements'] );--}}
{{--            echo '</ul></li>';--}}
{{--        }else{--}}
{{--            for($i = 0; $i < count($data); $i++){--}}
{{--                if( $data[$i]['slug'] === 'link' ){--}}
{{--                    echo '<li class="c-sidebar-nav-item">';--}}
{{--                    echo '<a class="c-sidebar-nav-link" href="' . env('APP_URL', '') . $data[$i]['href'] . '">';--}}
{{--                    echo '<span class="c-sidebar-nav-icon"></span>' . $data[$i]['name'] . '</a></li>';--}}
{{--                }elseif( $data[$i]['slug'] === 'dropdown' ){--}}
{{--                    renderDropdown( $data[$i] );--}}
{{--                }--}}
{{--            }--}}
{{--        }--}}
{{--    }--}}
{{--}--}}
{{--?>--}}

{{--<div class="c-sidebar-brand"><img class="c-sidebar-brand-full" src="{{ env('APP_URL', '') }}/assets/brand/coreui-base-white.svg" width="118" height="46" alt="CoreUI Logo"><img class="c-sidebar-brand-minimized" src="assets/brand/coreui-signet-white.svg" width="118" height="46" alt="CoreUI Logo"></div>--}}
{{--<ul class="c-sidebar-nav">--}}
{{--    @if(isset($appMenus['sidebar menu']))--}}
{{--        @foreach($appMenus['sidebar menu'] as $menuel)--}}
{{--            @if($menuel['slug'] === 'link')--}}
{{--                <li class="c-sidebar-nav-item">--}}
{{--                    <a class="c-sidebar-nav-link" href="{{ env('APP_URL', '') . $menuel['href'] }}">--}}
{{--                        @if($menuel['hasIcon'] === true)--}}
{{--                            @if($menuel['iconType'] === 'coreui')--}}
{{--                                <i class="{{ $menuel['icon'] }} c-sidebar-nav-icon"></i>--}}
{{--                            @endif--}}
{{--                        @endif--}}
{{--                        {{ $menuel['name'] }}--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            @elseif($menuel['slug'] === 'dropdown')--}}
{{--                <?php renderDropdown($menuel) ?>--}}
{{--            @elseif($menuel['slug'] === 'title')--}}
{{--                <li class="c-sidebar-nav-title">--}}
{{--                    @if($menuel['hasIcon'] === true)--}}
{{--                        @if($menuel['iconType'] === 'coreui')--}}
{{--                            <i class="{{ $menuel['icon'] }} c-sidebar-nav-icon"></i>--}}
{{--                        @endif--}}
{{--                    @endif--}}
{{--                    {{ $menuel['name'] }}--}}
{{--                </li>--}}
{{--            @endif--}}
{{--        @endforeach--}}
{{--    @endif--}}
{{--</ul>--}}
{{--<button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>--}}
{{--</div>--}}

<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand">
        NCKU Covid-19 TOCC
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-title">List <i class="cil-energy"></i>
        </li>
        <li class="c-sidebar-nav-item">
            <span class="cil-energy"></span>
            <a class="c-sidebar-nav-link" href="{{ route('topics.index') }}">
                <i class="c-sidebar-nav-icon cil-layers"></i>Topic List
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('clientUsers.index') }}">
                <i class="c-sidebar-nav-icon cil-user"></i>
                Client User List
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('homework.index') }}">
                <i class="c-sidebar-nav-icon cib-mysql"></i>
                DBMS homework
            </a>
        </li>
    </ul>
    <button class="c-sidebar-minimizer c-brand-minimizer" type="button"></button>
</div>
<link rel="stylesheet" href="https://unpkg.com/@coreui/icons/css/all.min.css">

