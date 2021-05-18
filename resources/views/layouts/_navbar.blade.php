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
    <li class="nav-item {{ $menu_active('invoices') }}">
        <a href="{{ has_route('invoices') }}" class="nav-link">
            <i class="link-icon" data-feather="file-text"></i>
            <span class="link-title">Invoices</span>
        </a>
    </li>
    <li class="nav-item {{ $menu_active('receipts') }}">
        <a href="{{ has_route('receipts') }}" class="nav-link">
            <i class="link-icon" data-feather="file-text"></i>
            <span class="link-title">Recepts</span>
        </a>
    </li>
</ul>
