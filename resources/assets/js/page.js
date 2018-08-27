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
        $("#body").fadeOut(100, function () {
            $(this).html(content).show();
            page.render();
        });
    },

    /**
     * Render the page
     */
    render () {
        createVue();
        $("#body").find("header:not(.visible),section:not(.visible)").each(function (i) {
            setTimeout(() => {
                $(this).addClass("visible");
            }, i * 100);
        });
    }
};
