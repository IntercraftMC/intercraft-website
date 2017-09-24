@extends("template.master")
@section("body")
    <div class="page">
    	@include("component.navbar")
    	@component("section.header")
            @slot("image") /uploads/blog/{{ $recent[0]->image }}.png @endslot
            @slot("heading") {{ $recent[0]->title }} @endslot
            @slot("buttonUrl") {{ route("blog_entry", ["slug" => $recent[0]->id]) }} @endslot
            @slot("buttonLabel") Read More @endslot
            {{ strip_tags($recent[0]->brief) }}
        @endcomponent
        @include("section.blog_entry", ["post" => $post])
    </div>
    @include("section.footer")
@endsection