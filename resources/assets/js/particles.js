const CONFIG = require("./config/particles");

window.particles = {
    /**
     * Render the particles
     */
    render () {
        console.log("Creating particles...");
        for (id in CONFIG) {
            if ($(`#${id}`).length) {
                console.log("Activating particles...");
                particlesJS(id, CONFIG[id]);
            }
        }
    }
};


