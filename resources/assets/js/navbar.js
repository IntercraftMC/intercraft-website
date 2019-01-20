// $(".navbar-brand a").mouseover(function () {
//     loading.once(".loading-logo-nav");
// });

/**
 * How far from the top can we be before it is no longer
 * considered the top
 */
const TOP_MARGIN = 100;

/**
 * Keep track if we're at the top of the page
 */
var top = true;
var small = false;

let updateNavbarStyle = function () {
    console.log("Updating...");
    $("nav.navbar").toggleClass("navbar-top",   top && !small)
                   .toggleClass("navbar-dark",  top && !small)
                   .toggleClass("navbar-light", !top || small)
                   .toggleClass("navbar-color", !top || small);
};

$(document).ready(() => {
    window.addEventListener("resize", function () {
        var isSmall = window.innerWidth < 768;
        console.log(isSmall);
        if (small != isSmall) {
            small = isSmall;
            $("header").toggleClass("small", small);
            updateNavbarStyle();
        }
    });
    navigate.event.on("scroll", function (pos) {
        var isTop = pos < TOP_MARGIN;
        if (top != isTop) {
            top = isTop;
            updateNavbarStyle();
        }
    });
    updateNavbarStyle();
});
