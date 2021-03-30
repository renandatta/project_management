@php
use Illuminate\Support\Facades\Session;
$fitur_program = $fitur_program ?? array();
$menu_active = function($route) {
    $menu_active = Session::get('menu_active') ?? '';
    return $menu_active == $route ? ' active show ' : '';
};
$sub_menu_active = function($route) {
    $sub_menu_active = Session::get('sub_menu_active') ?? '';
    return $sub_menu_active == $route ? ' active ' : '';
};
@endphp
<ul class="nav">
    <li class="nav-item {{ $menu_active('profiles') }}">
        <a href="{{ has_route('profiles') }}" class="nav-link">
            <i class="link-icon" data-feather="book"></i>
            <span class="link-title">Profiles</span>
        </a>
    </li>
    <li class="nav-item {{ $menu_active('clients') }}">
        <a href="{{ has_route('clients') }}" class="nav-link">
            <i class="link-icon" data-feather="user"></i>
            <span class="link-title">Clients</span>
        </a>
    </li>
    <li class="nav-item {{ $menu_active('projects') }}">
        <a href="{{ has_route('projects') }}" class="nav-link">
            <i class="link-icon" data-feather="folder"></i>
            <span class="link-title">Projects</span>
        </a>
    </li>
    @foreach($fitur_program as $item)
        @if(count($item['children']) == 0)
            <li class="nav-item {{ $menu_active($item->nama) }}">
                <a href="{{ has_route($item->url) }}" class="nav-link">
                    <i class="link-icon" data-feather="{{ $item->icon }}"></i>
                    <span class="link-title">{{ $item->nama }}</span>
                </a>
            </li>
        @else
            <li class="nav-item {{ $menu_active($item->nama) }}">
                <a class="nav-link" data-toggle="collapse" href="#error" role="button">
                    <i class="link-icon" data-feather="{{ $item->icon }}"></i>
                    <span class="link-title">{{ $item->nama }}</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ $menu_active($item->nama) }}" id="error">
                    <ul class="nav sub-menu">
                        @foreach($item['children'] as $sub_item)
                            <li class="nav-item">
                                <a href="{{ has_route($sub_item->url) }}" class="nav-link {{ $sub_menu_active($sub_item->nama) }}">{{ $sub_item->nama }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </li>
        @endif
    @endforeach
</ul>
