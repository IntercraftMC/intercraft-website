@extends("base.master")

{{-- Navbar and header--}}
@push("prebody")
    @include("component.navbar")
    <header-video>
    </header-video>
@endpush

{{-- Attach the default page --}}
@section("body")

    @isset($page)
        @include("$page", $vars)
    @endisset
@endsection
