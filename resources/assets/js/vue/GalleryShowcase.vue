<template>
    <div class="row showcase">
        <slot>
            <span class="no-images">No images available</span>
        </slot>
    </div>
</template>
<script>
export default {
    data () {
        return {
            gallery: null
        }
    },
    methods: {
        close () {
            if (this.gallery) {
                this.gallery.close();
            }
            this.gallery = null;
        },
        toItems () {
            let items = [];
            for (let image of this.$children) {
                let item = {
                    el  : image.$el,
                    src : image.src,
                    msrc: image.msrc,
                    pid : image.pid,
                    w   : image.w,
                    h   : image.h
                }
                items.push(item);
            }
            return items;
        },
        findIndex (id) {
            for (let i in this.$children) {
                if (this.$children[i].pid == id) {
                    return i;
                }
            }
            return -1;
        },
        openFromHash () {
            let id = window.location.hash.substring(1).match(/(?:^|&)pid=(\d+)/);
            if (id) {
                this.open(parseInt(id[1]));
            }
        },
        open (id) {
            let index = this.findIndex(id);
            if (index === -1) {
                this.close();
                return false;
            }

            let modal   = $(".pswp")[0];
            let options = {
                galleryUID: this.id,
                galleryPIDs: true,
                getThumbBoundsFn: (index) => {
                    let thumbnail = this.$children[index].$el.getElementsByTagName("img")[0];
                    let pageYScroll = window.pageYOffset || document.documentElement.scrollTop;
                    let rect = thumbnail.getBoundingClientRect();
                    return {
                        x: rect.left,
                        y: rect.top + pageYScroll,
                        w: rect.width
                    }
                },
                index: index
            };
            if (this.gallery) {
                this.close();
            }
            this.gallery = new PhotoSwipe(modal, PhotoSwipeUI, this.toItems(this.$children), options);
            this.gallery.init();
            return true;
        },
    },
    mounted () {
        for (let image of this.$children) {
            image.$on("click", this.open);
        };
        this.openFromHash();
    },
    props: {
        id: String
    },
    created () {
        window.addEventListener("hashchange", this.openFromHash);
    },
    destroyed () {
        window.removeEventListener("hashchange", this.openFromHash);
    }
}
</script>
