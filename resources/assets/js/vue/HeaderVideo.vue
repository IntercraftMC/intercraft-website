<template>
    <header class="video-header" id="video_header">
        <div id="particles_header" style="display: none;"></div>
        <div class="video-overlay container-fluid">
            <div class="row h-100">
                <div class="col-md-12 my-auto text-center">
                    <h1 class="display-1 align-middle header-brand text-invisible">
                        {{ title }}
                    </h1>
                    <p class="header-motto text-invisible">
                        {{ lead }}
                    </p>
                    <a href="" class="pointer"></a>
                </div>
            </div>
        </div>
    </header>
</template>

<script>
    export default {
        data () {
            return {
                queue: new EventQueue()
            }
        },
        methods: {
            /**
             * Cancel the current transition
             */
            __cancel () {
                this.queue.clear();
                $(this.$el).find("h1, p").stop().clearQueue();
                $(this.$el).find("video").parent().stop().clearQueue();
            },
            __setText(title, lead) {
                var elems = $(this.$el).find("h1, p");
                elems.addClass("text-invisible");
                this.queue.do((queue) => {
                    this.title = title;
                    this.lead  = lead;
                    elems.each(function (index) {
                        queue.do(() => {
                            $(this).removeClass("text-invisible");
                        }, index*300);
                    });
                }, 1000);
            },
            __setVideo (video) {
                $(this.$el).find("video").parent().fadeOut(500);
                this.queue.do((queue) => {
                    $(this.$el).vide(video, {
                        loop      : true,
                        muted     : true,
                        position  : "50% 50%",
                        posterType: "png",
                        resizing  : true
                    }).find("video").parent().hide();
                    queue.do(() => {
                        $(this.$el).find("video").parent().fadeIn(500);
                    }, 800);
                }, 300);
            },
            setHeader (video, title, lead) {
                this.__cancel();
                this.__setVideo(video);
                this.__setText(title, lead);
            }
        },
        mounted() {
            this.__cancel();
            $(this.$el).find("#particles_header").fadeIn(3000);
            this.setHeader(this.video, this.title, this.lead);
        },
        props: {
            "title": {
                "type": String,
                "default": "Intercraft"
            },
            "lead": {
                "type": String,
                "default": "Minecraft 1.12 Survival Server"
            },
            "video": {
                "type": String,
                "default": "/video/header"
            }
        }
    }
</script>
