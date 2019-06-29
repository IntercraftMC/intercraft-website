<template>
    <div class="video-header">
        <div class="overlay container-fluid">
            <div class="content">
                <h1 class="display-1">Intercraft</h1>
                <p>Minecraft 1.14.3 Survival Server</p>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    methods: {
        /**
         * Set the header content
         */
        setContent(video, title, description) {
            this.setVideo(video);
            this.setTitle(title);
            this.setDescription(description);
        },

        /**
         * Set the description of the header
         */
        setDescription(description) {

        },

        /**
         * Set the title of the header
         */
        setTitle(title) {

        },

        /**
         * Set the current video on the header
         */
        setVideo(video) {
            $(this.$el).vide(`/video/${video}`, {
                mp4: `/video/${video}`,
                posterType: "png"
            });
        }
    },
    mounted() {
        this.setVideo("header");
    },
    props: {
        disableParticles: {
            type: Boolean,
            default: false
        }
    }
}
</script>
