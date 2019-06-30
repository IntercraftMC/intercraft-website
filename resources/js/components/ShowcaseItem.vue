<template>
    <div class="col-12 col-md-6 col-xl-4 showcase-item hidden">
        <a href="#">
            <img :src="thumbnail" style="width: 100%;">
        </a>
        <div class="title text-center">
            <slot></slot>
        </div>
    </div>
</template>
<script>
export default {
    methods: {
        reveal() {
            $(this.$el).removeClass("hidden");
        }
    },
    props: [
        "thumbnail"
    ]
}
</script>
