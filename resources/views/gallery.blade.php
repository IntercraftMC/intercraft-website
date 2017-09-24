@extends("template.master")
@section("body")
    <div class="page">
    	@include("component.navbar")
    	@component("section.header")
            @slot("image") {{ headerImage() }} @endslot
            @slot("heading") The Gallery @endslot
            The gallery is comprised of the various builds that members have put together on the InterCraft server.
        @endcomponent
        @include("section.gallery")
    </div>
    @include("section.footer")
@endsection