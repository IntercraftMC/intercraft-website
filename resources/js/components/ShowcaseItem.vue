<template>
    <div class="col-12 col-md-6 col-xl-4">
        <div class="showcase-item hidden" ref="item">
            <a v-on:click="onClick()" class="thumbnail-link">
                <img :src="thumbnail" ref="thumbnail" style="width: 100%;">
            </a>
            <div class="title text-center">
                <slot></slot>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            isHidden: true
        }
    },
    methods: {
        /**
         * Invoked when the item is clicked
         */
        onClick() {
            this.$parent.__onItemClick(this);
        },
        /**
         * Reveal the showcase item and indicate if it's visible to the user
         */
        reveal() {
            this.isHidden = false;
            $(this.$refs.item).removeClass("hidden");
            return $(this.$el).isInViewport();
        }
    },
    props: {
        "showcaseId": {},
        "thumbnail": String
    }
}
</script>
