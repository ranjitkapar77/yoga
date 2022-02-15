
<header id="site_header">
    <nav class="navbar navbar-expand-lg" id="siteNavigation">
        <div class="container">
            <a class="navbar-brand" href="{{ route('index') }}">
                <img src="{{ image(config('settings.company_logo')) }}" alt="{{ config('settings.company_name') }}">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('index') }}">Home</a>
                    </li>
                    @foreach ($headerMenu as $key => $menu)
                    <li class="nav-item dropdown">
                        <a class="nav-link @if (count($menu->children)) dropdown-toggle @endif" href="{{ $menu->external_link ?? route('category', $menu->slug) }}" id="navbarDropdown" role="button" aria-expanded="false">
                            {{ $menu->name }}
                        </a>
                        @if (count($menu->children))
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @foreach ($menu->children as $child)
                                <li><a class="dropdown-item" href="{{ $child->external_link ?? route('category', $child->slug) }}">{{ $child->name }}</a></li>
                            @endforeach
                        </ul>
                        @endif
                    </li>
                    @endforeach
                </ul>

            </div>
        </div>
    </nav>
</header>

