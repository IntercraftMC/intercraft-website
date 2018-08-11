var tracker = {};

var deactivator = function (e) {
    if (e.target !== this)
        return;
    var logo = $(this).parents(".loading-logo");
    if (!tracker[logo[0]]) {
        logo.removeClass("active");
        $(this).off("animationiteration", deactivator);
        delete tracker[logo[0]];
    }
};

window.loading = {
    activate (selector) {
        $(selector).addClass("active").find(".logo-circles").on("animationiteration", deactivator);
        tracker[$(selector)[0]] = true;
    },

    deactivate (selector) {
        tracker[$(selector)[0]] = false;
    }
};
