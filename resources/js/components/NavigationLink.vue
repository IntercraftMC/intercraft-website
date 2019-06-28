<template>
    <li class="nav-item">
        <a v-bind:href="href" class="nav-link">
            <slot></slot>
        </a>
    </li>
</template>
<script>
export default {
    data() {
        return {
            url: new URL(this.href)
        }
    },
    methods: {
        /**
         * Activate the state as the active link
         */
        activate() {
            $(this.$el).addClass("active");
            return this;
        },

        /**
         * Deactivate the state as the active link
         */
        deactivate() {
            $(this.$el).removeClass("active");
            return this;
        }
    },
    props: [
        "href"
    ]
}
</script>

