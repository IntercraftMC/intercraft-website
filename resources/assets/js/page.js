/**
 * Create a new Vue instance
 */
var createVue = function () {
    page.app = new Vue({
        el: "#body"
    });
};

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
        $("#body").append(content);
        page.render();
    },

    /**
     * Set the current page content
     */
    set (title, content) {
        document.title = title;
        $("#body").fadeOut(page.TRANSITION_DELAY, function () {
            $(this).html(content).show();
            page.render();
        });
    },

    /**
     * Render the page
     */
    render () {
        createVue();
        particles.render();
        $("#body").find("header:not(.visible),section:not(.visible)").each(function (i) {
            setTimeout(() => {
                $(this).addClass("visible");
            }, i * page.TRANSITION_DELAY);
        });
    }
};
