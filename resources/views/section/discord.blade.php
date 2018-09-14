<section>
    <div class="container">
        <div class="row h-100">
            <div class="col-md-6 my-auto text-center-md">
                <h1 class="display-4">{{ __("content.discord.title") }}</h1>
                <p class="lead">{{ __("content.discord.lead") }}</p>
                <a href="{{ discord_invitation() }}" target="_blank" class="btn btn-lg btn-round btn-billboard btn-discord">
                    {{ __("content.discord.join") }}
                </a>
            </div>
            <div class="col-md-6 my-auto">
                <discord-background class="billboard"></discord-background>
            </div>
        </div>
    </div>
</section>
