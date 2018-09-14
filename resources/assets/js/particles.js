const CONFIG = require("./config/particles");

window.particles = {
    /**
     * Render the particles
     */
    render () {
        for (cls in CONFIG) {
            if ($(`#${cls}`).length) {
                particlesJS(cls, CONFIG[cls]);
            }
        }
    }
};


