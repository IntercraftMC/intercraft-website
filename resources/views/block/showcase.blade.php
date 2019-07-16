<section>
    <div class="container section-title">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4">{{ __("content.showcase.title") }}</h1>
                <p class="lead">{{ __("content.showcase.lead") }}</p>
            </div>
        </div>
    </div>
    <showcase-container v-bind:total-items="{{ count($items) }}" route="{{ route("showcase") }}" route-ajax="{{ route("ajax.showcase") }}">
        @foreach ($items as $item)
            <showcase-item image="{{ $item->imagePath() }}" showcase-id="{{ $item->id }}">
                {{ $item->title }}
            </showcase-item>
        @endforeach
    </showcase-container>
</section>
