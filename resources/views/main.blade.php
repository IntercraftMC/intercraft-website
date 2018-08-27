@extends("base.master")

{{-- Navbar --}}
@push("prebody")
    @include("component.navbar")
@endpush

{{-- Attach the default page --}}
@section("body")
    @isset($page)
        @include("$page", $vars)
    @endisset
@endsection

{{-- Run the scripts --}}
@push("scripts")
    <script>
        $(document).ready(() => {

        });
    </script>
@endpush
