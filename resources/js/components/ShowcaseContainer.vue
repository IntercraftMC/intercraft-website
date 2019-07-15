<template>
    <div class="container showcase">
        <div class="row" ref="container">
            <slot></slot>
        </div>
        <div class="row load-more text-center" ref="loadMore">
            <div class="col-12">
                <button class="btn btn-lg btn-primary btn-round" v-on:click="loadMore()">Load More</button>
            </div>
        </div>
    </div>
</template>
<script>
/**
 * Import the ShowcaseItem component
 */
import ShowcaseItem from "./ShowcaseItem.vue";

export default {
    beforeDestroy() {
        this.__unregisterEvents();
    },
    data() {
        return {
            activeItem    : null,
            items         : 0,
            hidden        : [],
            queue         : [],
            revealInterval: null
        }
    },
    methods: {
        /**
         * Cancel revealing items
         */
        cancelReveal() {
            clearInterval(this.revealInterval);
            this.revealInterval = null;
        },

        /**
         * Create and insert a showcase item
         */
        createItem(id, image, title, description) {
            let ShowcaseItemClass = Vue.extend(ShowcaseItem)
            let instance = new ShowcaseItemClass({
                propsData: {
                    showcaseId: id,
                    image : image,
                    description: description,
                }
            });
            instance.$slots.default = [title];
            instance.$parent = this;
            instance.$mount();
            this.$refs.container.appendChild(instance.$el);
            this.$children.push(instance);
            this.hidden.push(instance);
            this.items++;
            return instance;
        },

        /**
         * Load more images
         */
        loadMore() {
            for (let i = 0; i < 6; i++)
                this.createItem(this.items, "/img/discord_bg.svg", `Project ${this.$children.length}`);
            this.revealItems();
            this.__updateLoadMore();
        },

        /**
         * Hide the items
         */
        clearItems() {
            this.$children.forEach(child => child.remove());
        },

        /**
         * Reveal an item
         */
        revealNextItem() {
            let item = this.queue.shift();
            if (item) {
                item.reveal();
                if (!$(item.$el).isInViewport()) {
                    this.revealNextItem();
                }
            } else {
                clearInterval(this.revealInterval);
                this.revealInterval = null;
            }
        },

        /**
         * Reveal any visible items
         */
        revealItems() {
            if (this.hidden.length == 0) {
                return;
            }
            for (let i = 0; i < this.hidden.length;) {
                if ($(this.hidden[i].$el).isInViewport()) {
                    this.queue.push(this.hidden[i]);
                    this.hidden.splice(i, 1);
                } else {
                    i++;
                }
            }
            if (!this.revealInterval && this.queue.length > 0) {
                this.revealInterval = setInterval(this.revealNextItem, 100);
            }
        },

        /**
         * Invoked when component navigation is about to send a request
         */
        onNavigateBeforeLoad(ticket) {
            let slug = ticket.url.substring(this.route.length + 1);
            if (slug == null) {
                ticket.altUrl = this.routeAjax;
                // Send the slug so we can load the correct number of projects when returning
                if (this.showcaseId != null) {
                    ticket.parameters["showcase_id"] = this.showcaseId;
                }
            } else {
                ticket.altUrl = `${this.routeAjax}/${slug}`;
            }
            $(this.$el).addClass("is-loading");
        },

        /**
         * Invoked when component navigation yields an error
         */
        onNavigateError(response) {
            console.log("Component navigation yielded error:", response);
        },

        /**
         * Invoked when component navigation yields a response
         */
        onNavigateLoad(response) {
            let images = [];
            response.data.forEach((item) => { images.push(`${item.image}.png`); });
            utils.loadImages(images).then(() => {
                console.log("Loaded", images);
            });
            // this.cancelReveal();
            // this.clearItems();
            // setTimeout(() => {
            //     for (let item of Object.values(response.data)) {
            //         console.log("Creating item...");
            //         this.createItem(item.id, item.image, item.title, item.description);
            //     }

            //     this.revealItems();
            // }, 150);
        },

        /**
         * Invoked when an item is clicked
         */
        __onItemClick(item) {
            if (this.showcaseId) {
                return;
            }
            if (this.activeItem) {
                this.activeItem.stopLoading();
            }
            this.activeItem = item;
            navigate.to(`${this.route}/${item.showcaseId}`, {
                showcase_id: item.showcaseId
            }, this.route);
        },

        /**
         * Invoked when an item is ready to be displayed
         */
        __onItemReady() {
            this.revealItems();
        },

        /**
         * Invoked when the user scrolls
         */
        __onScroll() {
            this.revealItems();
        },

        /**
         * Update the load more button
         */
        __updateLoadMore() {
            $(this.$refs.loadMore).toggleClass("hidden", this.items >= this.totalItems)
        },

        /**
         * Register the events
         */
        __registerEvents() {
            $(window).on("scroll", this.__onScroll);
            if (this.route) {
                navigate.registerComponent(this, this.route);
            }
        },

        /**
         * Unregister the events
         */
        __unregisterEvents() {
            $(window).off("scroll", this.__onScroll);
            if (this.route) {
                navigate.unregisterComponent(this.route);
            }
        }
    },
    mounted() {
        this.__registerEvents();
        this.$children.forEach(item => this.hidden.push(item));
        this.items = this.hidden.length;
        this.__updateLoadMore();
        this.revealItems();
    },
    props: {
        "showcaseId": {
            "type": [String, null],
            "default": null
        },
        "route"     : String,
        "routeAjax" : String,
        "totalItems": {
            "type"   : Number,
            "default": 0
        }
    }
}
</script>
