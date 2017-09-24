@extends("template.master")
@section("body")
	@include("component.navbar")
	<iframe src="dynmap/index.html" frameborder="0" class="page"></iframe>
@endsection