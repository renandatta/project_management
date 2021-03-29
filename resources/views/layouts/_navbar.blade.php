@php
use Illuminate\Support\Facades\Session;
$fitur_program = $fitur_program ?? array();
$menu_aktif = function($route) {
    $menu_aktif = Session::get('menu_aktif') ?? '';
    return $menu_aktif == $route ? ' active show ' : '';
};
$sub_menu_aktif = function($route) {
    $sub_menu_aktif = Session::get('sub_menu_aktif') ?? '';
    return $sub_menu_aktif == $route ? ' active ' : '';
};
@endphp
<ul class="nav">
    @foreach($fitur_program as $item)
        @if(count($item['children']) == 0)
            <li class="nav-item {{ $menu_aktif($item->nama) }}">
                <a href="{{ has_route($item->url) }}" class="nav-link">
                    <i class="link-icon" data-feather="{{ $item->icon }}"></i>
                    <span class="link-title">{{ $item->nama }}</span>
                </a>
            </li>
        @else
            <li class="nav-item {{ $menu_aktif($item->nama) }}">
                <a class="nav-link" data-toggle="collapse" href="#error" role="button">
                    <i class="link-icon" data-feather="{{ $item->icon }}"></i>
                    <span class="link-title">{{ $item->nama }}</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ $menu_aktif($item->nama) }}" id="error">
                    <ul class="nav sub-menu">
                        @foreach($item['children'] as $sub_item)
                            <li class="nav-item">
                                <a href="{{ has_route($sub_item->url) }}" class="nav-link {{ $sub_menu_aktif($sub_item->nama) }}">{{ $sub_item->nama }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </li>
        @endif
    @endforeach
</ul>
