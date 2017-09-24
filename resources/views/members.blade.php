@extends("template.master")
@section("body")
    <div class="page">
    	@include("component.navbar")
    	@component("section.header")
            @slot("image") {{ headerImage() }} @endslot
            @slot("heading") InterCraft Members @endslot
            The complete list of InterCraft members
        @endcomponent
        @include("section.members", [
        	"admins" => $admins
        ])
    </div>
    @include("section.footer")
@endsection