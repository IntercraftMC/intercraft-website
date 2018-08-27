var tracker = {};

/**
 * Invoked when the animation finishes an iteration
 */
var finished = function (e) {
    if (e.target !== this)
        return;
    var logo = $(this).parents(".loading-logo");
    if (!tracker[logo[0]]) {
        logo.removeClass("active");
        $(this).off("animationiteration", finished);
        delete tracker[logo[0]];
    }
};

/**
 * Reset the loading animation
 */
var reset = function () {

};

window.loading = {

    /**
     * Activate a loading animation
     */
    activate (selector) {
        if ($(selector).hasClass("active"))
            return false;
        $(selector).addClass("active").find(".logo-circles").on("animationiteration", finished);
        tracker[$(selector)[0]] = true;
        return true;
    },

    /**
     * Deactivate a loading animation
     */
    deactivate (selector) {
        tracker[$(selector)[0]] = false;
    },

    /**
     * Play a single iteration of a loading animation
     */
    once (selector) {
        if (this.activate(selector))
            this.deactivate(selector);
    }
};
