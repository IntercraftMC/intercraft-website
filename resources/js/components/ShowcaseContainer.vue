<template>
    <div class="container showcase">
        <div class="row" ref="container">
            <slot></slot>
        </div>
        <div class="row text-center">
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
    data() {
        return {
            hidden        : [],
            queue         : [],
            revealInterval: null,
        }
    },
    methods: {

        /**
         * Create and insert a showcase item
         */
        createItem(thumbnail, title) {
            let ShowcaseItemClass = Vue.extend(ShowcaseItem)
            let instance = new ShowcaseItemClass({
                propsData: { thumbnail: "/img/discord_bg.svg" },
            });
            instance.$slots.default = [title];
            instance.$parent = this;
            instance.$mount();
            this.$refs.container.appendChild(instance.$el);
            this.$children.push(instance);
            this.hidden.push(instance);
            return instance;
        },

        /**
         * Load more images
         */
        loadMore() {
            for (let i = 0; i < 6; i++)
                this.createItem("/img/discord_bg.svg", `Project ${this.$children.length}`);
            this.revealItems();
        },

        /**
         * Reveal an item
         */
        revealItem() {
            let item = this.queue.shift();
            if (item) {
                item.reveal()
                if (!$(item.$el).isInViewport()) {
                    this.revealItem();
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
                this.revealInterval = setInterval(this.revealItem, 100);
            }
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
    },
    mounted() {
        this.$children.forEach(item => this.hidden.push(item));
        $(window).on("scroll", this.__onScroll);
    }
}
</script>
