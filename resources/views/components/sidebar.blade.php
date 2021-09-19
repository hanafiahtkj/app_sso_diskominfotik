@php
$links = [
    [
        "icon" => "fas fa-home",
        "href" => "welcome2",
        "text" => "Beranda",
        "is_multi" => false,
    ],
    [
        "icon" => "fas fa-question-circle",
        "href" => "pages.about",
        "text" => "Tentang",
        "is_multi" => false,
    ],
];
$navigation_links = array_to_object($links);
@endphp
<nav class="navbar navbar-secondary navbar-expand-lg">
<div class="container">
    <ul class="navbar-nav">
        @foreach ($navigation_links as $link)
            @if (!$link->is_multi)
            <li class="nav-item {{ Request::routeIs($link->href) ? 'active' : '' }}">
              <a href="{{ route($link->href) }}" class="nav-link"><i class="{{ $link->icon }}"></i><span>{{ $link->text }}</span></a>
            </li>
            @else
            @foreach ($link->href as $section)
                @php
                $routes = collect($section->section_list)->map(function ($child) {
                    return Request::routeIs($child->href);
                })->toArray();

                $is_active = in_array(true, $routes);
                @endphp

            <li class="nav-item dropdown {{ ($is_active) ? 'active' : '' }}">
              <a href="#" data-toggle="dropdown" class="nav-link has-dropdown" aria-expanded="false"><i class="{{ $link->icon }}"></i><span>{{ $link->text }}</span></a>
              <ul class="dropdown-menu">
                @foreach ($section->section_list as $child)
                    <li class="nav-item {{ Request::routeIs($child->href) ? 'active' : '' }}"><a class="nav-link" href="{{ route($child->href) }}">{{ $child->text }}</a></li>
                @endforeach
              </ul>
            </li>
            @endforeach
            @endif 
        @endforeach
        </ul>
        @role('Admin')
        <ul class="navbar-nav navbar-right">
          <li class="nav-item dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link has-dropdown" aria-expanded="false"><i class="fas fa-desktop"></i><span>Menu Admin</span></a>
            <ul class="dropdown-menu">
              <li class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link">Dasbor</a></li>
              <li class="nav-item"><a href="{{ route('app.index') }}" class="nav-link">Data Aplikasi</a></li>
              <li class="nav-item"><a href="{{ route('user') }}" class="nav-link">Data User</a></li>
              <li class="nav-item"><a href="{{ route('settings.index') }}" class="nav-link">Pengaturan</a></li>
            </ul>
          </li>
        </ul>
        @endrole
</div>
</nav>
