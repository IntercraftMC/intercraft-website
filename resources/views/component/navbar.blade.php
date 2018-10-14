<nav class="navbar navbar-top navbar-expand-md navbar-dark" style="display: none;">
    <div class="container-fluid">
        <div class="navbar-brand">
            <a href="#">
                <loading-logo class="loading-logo-nav" ref="nav_logo"></loading-logo>
                <span>Intercraft</span>
            </a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_content" aria-controls="navbar_content" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar_content">
            <ul class="navbar-nav ml-auto">
                @foreach (config("navbar")["links"] as $link)
                    <li class="nav-item">
                        <a href="{{ route($link["route"]) }}" class="nav-link">
                            {{ __($link["label"]) }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</nav>
