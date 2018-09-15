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

navigate.event.on("scroll", function (pos) {
    var isTop = pos < TOP_MARGIN;
    if (top != isTop) {
        top = isTop;
        $("nav.navbar").toggleClass("navbar-top", top)
                       .toggleClass("navbar-dark", top)
                       .toggleClass("navbar-light", !top)
                       .toggleClass("navbar-color", !top);
        console.log("Navbar changed state");
    }
});
