<ul class="navbar-nav pt-lg-3">
    @foreach (config('menu') as $item)

        {{-- RENDER PEMBATAS / HEADER MENU --}}
        @if (isset($item['is_header']) && $item['is_header'])
            <li class="nav-item">
                <div class="text-muted px-3 my-2" style="font-size: 0.75rem; font-weight: 600; letter-spacing: .08em; text-transform: uppercase;">
                    {{ $item['title'] }}
                </div>
            </li>

        {{-- RENDER MENU DROPDOWN --}}
        @elseif ($item['is_dropdown'])
            @php
                $isActive = false;
                foreach ($item['submenus'] as $sub) {
                    if (Route::has($sub['route']) && request()->routeIs($sub['route'])) {
                        $isActive = true;
                        break;
                    }
                }
            @endphp

            <li class="nav-item dropdown {{ $isActive ? 'active' : '' }}">
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" role="button">
                    <span class="nav-link-icon">
                        {!! $item['icon'] !!}
                    </span>
                    <span class="nav-link-title">{{ $item['title'] }}</span>
                </a>
                <div class="dropdown-menu {{ $isActive ? 'show' : '' }}">
                    @foreach ($item['submenus'] as $sub)
                        <a class="dropdown-item {{ request()->routeIs($sub['route']) ? 'active' : '' }}"
                            href="{{ Route::has($sub['route']) ? route($sub['route']) : '#' }}">
                            {{ $sub['title'] }}
                        </a>
                    @endforeach
                </div>
            </li>

        {{-- RENDER MENU SINGLE --}}
        @else
            <li class="nav-item {{ request()->routeIs($item['route']) ? 'active' : '' }}">
                <a class="nav-link" href="{{ Route::has($item['route']) ? route($item['route']) : '#' }}">
                    <span class="nav-link-icon">
                        {!! $item['icon'] !!}
                    </span>
                    <span class="nav-link-title">{{ $item['title'] }}</span>
                </a>
            </li>
        @endif

    @endforeach
</ul>
