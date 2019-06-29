<template>
    <div class="video-header">
        <div class="overlay container-fluid"></div>
    </div>
</template>
<script>
export default {
    methods: {
        /**
         * Set the current video on the header
         */
        setVideo(video) {
            $(this.$el).vide(video, {
                mp4: `video/${video}`,
                posterType: "png"
            });
        }
    },
    mounted() {
        this.setVideo("/video/header");
    },
    props: {
        disableParticles: {
            type: Boolean,
            default: false
        }
    }
}
</script>
