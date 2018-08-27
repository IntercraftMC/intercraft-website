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

window.loading = {

    /**
     * Activate a loading animation
     */
    activate (elem) {
        if (tracker[elem[0]])
            return false;
        elem.addClass("active").find(".logo-circles").on("animationiteration", finished);
        tracker[elem[0]] = true;
        return true;
    },

    /**
     * Deactivate a loading animation
     */
    deactivate (elem) {
        console.log("Deactivating...");
        tracker[elem[0]] = false;
    },

    /**
     * Play a single iteration of a loading animation
     */
    once (elem) {
        if (this.activate(elem))
            this.deactivate(elem);
    }
};
