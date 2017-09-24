@extends("template.master")
@section("body")
    <div class="page">
    	@include("component.navbar")
    	@component("section.header")
            @slot("image") {{ headerImage() }} @endslot
            @slot("heading") Become a Member @endslot
            While InterCraft is a private whitelisted server, we do accept applications to join!
        @endcomponent
        @include("section.join")
    </div>
    @include("section.footer")
@endsection