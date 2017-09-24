@extends("template.master")
@section("body")
    <div class="page">
    	@include("component.navbar")
    	@include("section.member")
    </div>
    @include("section.footer")
@endsection