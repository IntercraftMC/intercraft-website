<template>
    <div class="container showcase">
        <div class="row">
            <slot></slot>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            revealInterval: null,
            queue: []
        }
    },
    methods: {
        reveal() {
            let item = this.queue.shift();
            if (!item) {
                clearInterval(this.revealInterval);
                return;
            }
            item.reveal();
        },
        revealItems() {
            if (!this.revealInterval) {
                this.revealInterval = setInterval(this.reveal, 150);
            }
        }
    },
    mounted() {
        setTimeout(() => {
            this.$children.forEach((item) => {
                this.queue.push(item);
            });
            this.revealItems();
        }, 2000);
    }
}
</script>
