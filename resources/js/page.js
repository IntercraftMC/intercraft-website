/**
 * Create a new Vue instance
 */
var createVue = function() {
    page.app = new Vue({
        el: "#app"
    });
};

/**
 * Destroy the current Vue instance
 */
var destroyVue = function() {
    if (page.app) {
        page.app.$destroy();
        page.app = null;
    }
}

/**
 * Set the content of the body
 */
var setBody = function(content) {
    destroyVue();
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
    createVue();
    $("#app").show();
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
        createVue();
    }
};
