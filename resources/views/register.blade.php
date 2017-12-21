@extends("template.master")
@section("body")
    <div class="page">
    	@include("component.navbar")
    	@component("section.header")
            @slot("image") {{ headerImage() }} @endslot
            @slot("heading") Complete Your Membership @endslot
            Now that you're a member, it is time to complete your registration
        @endcomponent
        @include("section.register")
    </div>
    @include("section.footer")
@endsection
