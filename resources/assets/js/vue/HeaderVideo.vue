<template>
    <header class="video-header" id="video_header">
        <div class="video-overlay container-fluid">
            <div class="row h-100">
                <div class="col-md-12 my-auto text-center">
                    <div class="header-title-container text-invisible">
                        <h1 class="display-1 align-middle header-brand">
                            {{ titleText }}
                        </h1>
                    </div>
                    <div class="header-motto-container text-invisible">
                        <p class="header-motto">
                            {{ leadText }}
                        </p>
                    </div>
                    <a href="" class="pointer"></a>
                </div>
            </div>
        </div>
        <div id="particles_header" style="display: none;"></div>
    </header>
</template>

<script>
    export default {
        data () {
            return {
                resizeSensor: null,
                leadText    : this.lead,
                titleText   : this.title,
                queue       : new EventQueue(),
                timings     : {
                    "text": [
                        [1000, 300],
                        [500, 300],
                    ],
                    "video": [
                        [500, 300, 800],
                        [300, 300, 500],
                    ]
                }
            }
        },
        methods: {
            /**
             * Cancel the current transition
             */
            __cancel () {
                this.queue.clear();
                $(this.$el).find(".header-title-container, .header-motto-container").stop().clearQueue();
                $(this.$el).find("video").parent().stop().clearQueue();
            },
            __setSize (size, timingsIndex) {
                if (timingsIndex) {
                    this.queue.do(() => {
                        $(this.$el).removeClass().addClass(`video-header video-header-${size}`);
                    }, this.timings.video[1][0]);
                } else {
                    $(this.$el).removeClass().addClass(`video-header video-header-${size}`);
                }
            },
            __setText (title, lead, timingsIndex) {
                var timings = this.timings.text[timingsIndex];
                var elems   = $(this.$el).find(".header-title-container, .header-motto-container");
                elems.addClass("text-invisible");
                if (title) {
                    this.queue.do((queue) => {
                        this.titleText = title;
                        this.leadText  = lead;
                        elems.each(function (index) {
                            queue.do(() => {
                                $(this).removeClass("text-invisible");
                            }, index*timings[1]);
                        });
                    }, timings[0]);
                }
            },
            __setVideo (video, timingsIndex) {
                var timings = this.timings.video[timingsIndex];
                $(this.$el).find("video, canvas").parent().fadeOut(timings[0]);
                if (video) {
                    this.queue.do((queue) => {
                        $(this.$el).vide(video, {
                            loop      : true,
                            muted     : true,
                            position  : "50% 50%",
                            posterType: "png",
                            resizing  : true
                        }).find("video").parent().hide();
                        queue.do(() => {
                            $(this.$el).find("video, canvas").parent().fadeIn(timings[0]);
                            window.dispatchEvent(new Event('resize'));
                        }, timings[2]);
                    }, timings[1]);
                }
            },
            setHeader (header, timings = 1) {
                if (!header) {

                }
                header = header || {};
                this.__cancel();
                this.__setSize(header.size, timings);
                this.__setVideo(header.video, timings);
                this.__setText(header.title, header.lead, timings);
            }
        },
        mounted() {
            this.__cancel();
            $(this.$el).find("#particles_header").fadeIn(3000);
            this.setHeader({
                video: this.video,
                title: this.title,
                lead : this.lead,
                size : this.size
            }, 0);
        },
        props: {
            "title": String,
            "lead" : String,
            "video": String,
            "size" : String
        }
    }
</script>
