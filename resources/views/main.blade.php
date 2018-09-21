@extends("base.master")

{{-- Navbar and header--}}
@push("prebody")
    @include("component.navbar")
    <header-video title="Intercraft" lead="Minecraft 1.12 Survival Server" video="/video/header">
    </header-video>
@endpush

{{-- Attach the default page --}}
@section("body")

    @isset($page)
        @include("$page", $vars)
    @endisset
@endsection
