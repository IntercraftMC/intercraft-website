/**
 * Keep track of the sections that are hidden
 */
var hiddenSections = new Set();

/**
 * Create a new Vue instance
 */
var createVue = function () {
    page.app = new Vue({
        el: "#body"
    });
};

/**
 * Display the visible sections
 */
var displaySections = function () {
    hiddenSections.forEach((section) => {
        if ($(section).isInViewport()) {
            $(section).addClass("visible");
            hiddenSections.delete(section);
        }
    });
};

/**
 * Locate any hidden sections and keep track of them
 */
var findHiddenSections = function () {
    hiddenSections.clear();
    $("#body").find("section:not(.visible)").each(function () {
        hiddenSections.add(this);
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
        $("#body").stop().clearQueue();
        $("#body").fadeOut(page.TRANSITION_DELAY, function () {
            $(this).html(content).show();
            createVue();
            findHiddenSections();
            page.render();
        });
    },

    /**
     * Render the page
     */
    render () {
        displaySections();
    },

    /**
     * Initial rendering of the page
     */
    init () {
        createVue();
        findHiddenSections();
        particles.render();
        $(".navbar").fadeIn(1000);
        setTimeout(() => {
            page.render();
        }, 1400);
    }
};
