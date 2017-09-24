@extends("template.master")
@section("body")
    <div class="page">
    	@include("section.home_header")
    	@include("section.about", ['brief' => True])
    	@include("section.features")
    	@include("section.gallery", [
    		'brief' => True,
    		'images' => $images
    	])
    </div>
    @include("section.footer")
@endsection