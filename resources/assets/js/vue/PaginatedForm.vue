<template>
    <div class="paginated-form">
        <section class="container-breadcrumbs">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <hr>
                        <ul>
                            <li v-for="(page, i) in pages" :data-page="i" :class="i == 0 ? 'active' : ''" v-bind:key="i">
                                <div :class="'bg-' + page.getAttribute('icon-color')" v-on:click="changePage">
                                    <i :class="page.getAttribute('icon')"></i>
                                </div>
                                <span>{{ page.getAttribute("label") }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section class="container-pages" v-cloak>
            <slot></slot>
        </section>
        <section class="container-page-buttons">
            <div class="container">
                <div class="row">
                    <div class="col-6 text-left">
                        <button v-on:click="previous" class="btn btn-md btn-danger btn-round" type="button">Back</button>
                    </div>
                    <div class="col-6 text-right">
                        <button v-on:click="next" class="btn btn-md btn-primary btn-round" type="button">Next</button>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
<script>
export default {
    data () {
        return {
            page : -1,
            pages: null
        }
    },
    methods: {
        changePage (event) {
            this.setPage($(event.target).parents("li").prevAll().length);
        },
        setPage (page) {
            page = Math.min(this.pages.length - 1, Math.max(page, 0));
            if (page == this.page)
                return;
            $(this.$el).find(".container-breadcrumbs .active").removeClass("active");
            $(this.$el).find(`.container-breadcrumbs li[data-page="${page}"]`).addClass("active");
            $(this.pages[page]).removeClass().addClass("active").height();
            $(this.pages[page]).prevAll().removeClass().addClass("left");
            $(this.pages[page]).nextAll().removeClass().addClass("right");
            this.page = page;
            this.resize();
        },
        next () {
            this.setPage(this.page + 1)
        },
        previous () {
            this.setPage(this.page - 1);
        },
        resize () {
            $(".container-pages").css("height", $(this.pages[this.page]).outerHeight() + "px");
        }
    },
    mounted () {
        var pages  = $(this.$el).find(".container-pages").children();
        this.pages = pages.toArray();
        this.setPage(0);
        $(window).on("resize", this.resize);
    }
}
</script>
