<template>
    <div class="col-12 col-md-6 col-xl-4">
        <div class="showcase-item hidden" ref="item">
            <a v-on:click="onClick()" class="thumbnail-link">
                <img :src="`${image}_thumb.png`" ref="thumbnail" style="width: 100%;">
                <div class="overlay" ref="overlay">
                    <div class="loading-icon-container">
                        <intercraft-logo class="loading-icon" is-animated ref="loadingIcon"></intercraft-logo>
                    </div>
                </div>
            </a>
            <div class="title text-center">
                <slot></slot>
            </div>
        </div>

    </div>
</template>
<script>
export default {
    beforeDestroy() {
        this.$el.parentNode.removeChild(this.$el);
    },
    data() {
        return {
            isHidden: true
        }
    },
    methods: {
        /**
         * Display the loading animation
         */
        startLoading() {
            $(this.$refs.item).addClass("active");
            if (this.$refs.loadingIcon) {
                this.$refs.loadingIcon.activate();
            }
        },

        /**
         * Hide the loading animation
         */
        stopLoading() {
            $(this.$refs.item).removeClass("active");
            if (this.$refs.loadingIcon) {
                this.$refs.loadingIcon.deactivate();
            }
        },

        /**
         * Invoked when the item is clicked
         */
        onClick() {
            if (this.isGalleryItem) {
                return;
            }
            this.startLoading();
            this.$parent.__onItemClick(this);
        },

        /**
         * Remove the element
         */
        remove() {
            // $(this.$refs.item).addClass("hidden");
            setTimeout(() => this.$destroy(), 150);
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
        "description": String,
        "image" : String,
        "isGalleryItem": Boolean,
        "showcaseId": {}
    }
}
</script>
