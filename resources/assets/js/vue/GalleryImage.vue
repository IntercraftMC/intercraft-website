<template>
    <div class="form-group col-lg-4 col-md-6 showcase-image">
        <a :href="src" itemprop="contentUrl" @click="onClick">
            <img :src="msrc" itemprop="thumbnail" :alt="description"/>
        </a>
    </div>
</template>
<script>
export default {
    methods: {
        onClick (e) {
            e.preventDefault();
            this.$emit("click", this.pid);
        }
    },
    props: {
        pid: {
            type: String,
            required: true
        },
        src : {
            type    : String,
            required: true
        },
        msrc : {
            type    : String,
            required: true
        },
        w: {
            type: Number,
            required: true
        },
        h: {
            type: Number,
            required: true
        },
        title      : String,
        description: String
    }
}
</script>
