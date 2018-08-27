<nav class="navbar navbar-lg navbar-expand-lg navbar-light navbar-color">
    <div class="container-fluid">
        <div class="navbar-brand">
            <a href="#">
                <loading-logo class="loading-logo-nav" id="loading-logo"></loading-logo>
                <span>INTERCRAFT</span>
            </a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_content" aria-controls="navbar_content" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar_content">
            <ul class="navbar-nav ml-auto">
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
                <li class="nav-item">

                </li>
            </ul>
        </div>
    </div>
</nav>
