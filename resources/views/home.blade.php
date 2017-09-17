@extends("template.master")
@section("body")
    @include("section.home_header")
    @include("section.about", ['brief' => True])
    @include("section.features")
    @include("section.gallery", ['brief' => True])
    @include("section.footer")
@endsection