<template>
    <div>
        <input :type="type" class="form-control">
        <i :class="icon"></i>
    </div>
</template>
<script>
export default {
    mounted () {
        var input = $(this.$el).find("input");
        $.each(this.$el.attributes, function () {
            if (this.specified) {
                input.attr(this.name, this.value);
            }
        });
        $(this.$el).addClass("icon-input");
    },
    props: {
        type: {
            type   : String,
            default: "type"
        },
        icon: {
            type    : String,
            required: true
        }
    }
}
</script>
