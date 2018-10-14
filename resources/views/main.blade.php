@extends("base.master")

{{-- Navbar and header--}}
@push("prebody")
    @include("component.navbar")
    <header-video ref="header" {!! header_attributes($header) !!}>
    </header-video>
@endpush

{{-- Attach the default page --}}
@section("body")

    @isset($page)
        @include("$page", $vars)
    @endisset
@endsection
