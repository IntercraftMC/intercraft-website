const CONFIG = require("./config");
/**
 * Create a new Vue instance
 */
var createVueApp = function() {
    page.app = new Vue({ el: "#app" });
};

/**
 * Destroy the current Vue instance
 */
var destroyVueApp = function() {
    if (page.app) {
        page.app.$destroy();
        page.app = null;
    }
}

/**
 * Set the content of the body
 */
var setBody = function(content) {
    destroyVueApp();
    $("#app").stop().clearQueue();
    $("#app").fadeOut(page.TRANSITION_DELAY, function () {
        $(this).html(content);
        render();
    });
};

/**
 * Render the contents of the page
 */
var render = function() {
    $("#app").show();
    createVueApp();
}

/**
 * Render the particles
 */
var renderParticles = function() {
    if (utils.isMobile()) {
        return;
    }
    for (id in CONFIG.particles) {
        if ($(`#${id}`).length) {
            particlesJS(id, CONFIG.particles[id]);
        }
    }
}

/**
 * Page management
 */
window.page = {

    /**
     * The amount of delay for transitions in miliseconds
     */
    TRANSITION_DELAY: 100,

    /**
     * The Vue app instance
     */
    app: null,

    /**
     * The Vue header instance
     */
    header: null,

    /**
     * Append content to the page
     */
    append (content) {
        $("#app").append(content);
        render();
    },

    /**
     * Set the current page content
     */
    set (title, header, content) {
        document.title = title;
        setBody(content);
    },

    /**
     * Initial rendering of the page
     */
    init () {
        page.header = new Vue({ el: "header" });
        createVueApp();
        renderParticles(); // Needs to be moved to the render function later
    }
};
