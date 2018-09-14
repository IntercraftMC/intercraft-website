<template>
    <header class="video-header">
        <div id="particles-header"></div>
        <div class="video-overlay container-fluid">
            <div class="row h-100">
                <div class="col-md-12 my-auto text-center">
                    <h1 class="display-1 align-middle header-brand">INTERCRAFT</h1>
                    <p class="header-motto">Minecraft 1.12.2 Survival Server</p>
                    <a href="" class="pointer"></a>
                </div>
            </div>
        </div>
    </header>
</template>

<script>
    export default {
        mounted() {
            $(this.$el).vide("/video/header", {
                loop      : true,
                muted     : true,
                position  : "50% 50%",
                posterType: "png",
                resizing  : true
            });
        }
    }
</script>
