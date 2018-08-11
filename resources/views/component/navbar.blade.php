<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">
            @svg("logo.svg", "loading-logo loading-logo-nav")
            INTERCRAFT
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_content" aria-controls="navbar_content" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar_content">
            <ul class="navbar-nav mr-auto">
                @foreach (config("navbar")["links"] as $link)
                    @if (is_nav_item_active($link["route"]))
                        <li class="nav-item">
                            <a href="{{ route($link["route"]) }}" class="nav-link">
                                {{ __($link["label"]) }}
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ $link["route"] }}" class="nav-link"></a>
                        </li>
                    @endif
                @endforeach
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>
{{-- <nav class="navbar {{ isset($home) ? "navbar-home navbar-absolute" : "" }} navbar-toggleable-md navbar-inverse navbar-color">
    <div class="container-fluid">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle Navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href=""> --}}
            {{-- <div class="d-inline-block align-top">
                @svg("logo.svg", "loading-logo loading-logo-nav")
            </div> --}}
            {{-- InterCraft
        </a>

        @php $name = Route::currentRouteName(); @endphp
        <div class="collapse navbar-collapse justify-content-end" id="navbar">
            <ul class="navbar-nav mt-2 mt-sm-0">
                <li class="nav-item">
                    <a href="" class="nav-link">Home</a>
                </li> --}}
                {{-- <li class="nav-item {{ ($name == 'home') ? 'active': '' }}">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item {{ ($name == 'about') ? 'active': '' }}">
                    <a class="nav-link" href="{{ route('about') }}">About</a>
                </li>
                <li class="nav-item {{ (0 === strpos($name, 'blog')) ? 'active': '' }}">
                    <a class="nav-link" href="{{ route('blog') }}">Blog</a>
                </li>
                <li class="nav-item {{ ($name == 'gallery') ? 'active': '' }}">
                    <a class="nav-link" href="{{ route('gallery') }}">Gallery</a>
                </li>
                <li class="nav-item {{ (0 === strpos($name, 'members')) ? 'active': '' }}">
                    <a class="nav-link" href="{{ route('members') }}">Members</a>
                </li>
                <li class="nav-item {{ ($name == 'map') ? 'active': '' }}">
                    <a class="nav-link" href="{{ route('map') }}">Live Map</a>
                </li>
                <li class="nav-item {{ ($name == 'join') ? 'active': '' }}">
                    <a class="nav-link" href="{{ route('join') }}">Sign Up</a>
                </li> --}}
            {{-- </ul>
        </div>
    </div>
</nav> --}}
