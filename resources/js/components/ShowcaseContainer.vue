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
            items         : 0,
            hidden        : [],
            queue         : [],
            revealInterval: null,
        }
    },
    methods: {
        /**
         * Create and insert a showcase item
         */
        createItem(id, thumbnail, title) {
            let ShowcaseItemClass = Vue.extend(ShowcaseItem)
            let instance = new ShowcaseItemClass({
                propsData: {
                    showcaseId: id,
                    thumbnail : thumbnail
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
        onNavigateRequest(request) {
            if (request.slug == null && this.showcaseId != null) {
                request.parameters["showcase_id"] = this.showcaseId;
            }
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
        onNavigateResponse(response) {
            console.log("Component navigation yielded response:", response);
        },

        /**
         * Invoked when an item is clicked
         */
        __onItemClick(item) {
            navigate.to(`${this.route}/${item.showcaseId}`);
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
