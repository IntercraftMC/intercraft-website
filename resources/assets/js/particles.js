const CONFIG = require("./config/particles");

window.particles = {
    /**
     * Render the particles
     */
    render () {
        if (utils.isMobile())
            return;
        for (id in CONFIG) {
            if ($(`#${id}`).length) {
                particlesJS(id, CONFIG[id]);
            }
        }
    }
};


