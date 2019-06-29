<template>
    <nav class="navbar navbar-top navbar-expand-md fixed-top">
        <div class="container">
            <div class="navbar-brand">
                <a href="/">
                    <intercraft-logo class="logo-nav" ref="logo" is-animated></intercraft-logo>
                    <span>Intercraft</span>
                </a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_content" aria-controls="navbar_content" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar_content">
                <ul class="navbar-nav ml-auto">
                    <slot></slot>
                </ul>
            </div>
        </div>
    </nav>
</template>
<script>
    export default {
        data() {
            return {
                // Store the current URL for reference
                activeLink: null,
                currentUrl: null,
                routes: {}
            }
        },
        methods: {
            /**
             * Initialize the routes
             */
            initRoutes() {
                for (let link of this.links()) {
                    this.routes[link.url.pathname] = link;
                }
                this.routes["/index"] = this.routes['/'];
            },

            /**
             * Fetch the link components
             */
            links() {
                return this.$children.filter(child => {
                    return child.$options._componentTag === "navigation-link"
                });
            },

            /**
             * Invoked when navigation events are emitted
             */
            onNavigate(url) {
                if (url != undefined && url != this.currentUrl.href) {
                    this.setCurrentUrl(url);
                } else if (location.href != this.currentUrl.href) {
                    this.setCurrentUrl(location.href);
                }
            },

            /**
             * Set the current URL
             */
            setCurrentUrl(url) {
                this.currentUrl = new URL(url);
                this.updateActiveLink();
            },

            /**
             * Update the active link
             */
            updateActiveLink() {
                let root  = this.routes;
                let parts = this.currentUrl.pathname.substring(1).split('/');
                for (let i = 0; i < parts.length && !(root instanceof Vue); i++) {
                    root = this.routes['/' + parts[i]];
                    if (root instanceof Vue) {
                        if (root !== this.activeLink) {
                            if (this.activeLink) {
                                this.activeLink.deactivate();
                            }
                            this.activeLink = root.activate();
                        }
                    }
                }
            }
        },
        mounted() {
            // Register the navigation events
            navigate.event.on("beforeload", this.onNavigate);
            navigate.event.on("beforeload", this.$refs.logo.activate);
            navigate.event.on("error",      this.onNavigate);
            navigate.event.on("error",      this.$refs.logo.deactivate);
            navigate.event.on("load",       this.onNavigate);
            navigate.event.on("load",       this.$refs.logo.deactivate);

            // Initialize the route tree
            this.initRoutes();

            // Initialize the current URL
            this.setCurrentUrl(location.href);
        }
    }
</script>
