@extends("template.master")
@section("body")
    <div class="page">
        @include("component.navbar")
        @component("section.header")
            @slot("image") {{ headerImage() }} @endslot
            @slot("heading") About InterCraft @endslot
            InterCraft is a lightly modded Minecraft survival server...
        @endcomponent
        @include("section.about")
        @include("section.features")
        @include("section.modpack", [ "mods" => $mods ])
    </div>
    @include("section.footer")
@endsection