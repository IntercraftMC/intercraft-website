
/**
 * First we will load all of this project"s JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

require("./event_queue");
require("./form");
require("./navigation");
require("./utils");

require("./components");
require("./navbar");
require("./page");
require("./particles");

const prebody = new Vue({
    el: "#prebody"
});

var onBeforeLoad = function () {
    prebody.$refs.nav_logo.start();
};

var onLoad = function () {
    prebody.$refs.nav_logo.stop();
};

/**
 * Render the web page on load
 */
$(document).ready(function () {
    navigate.init();
    navigate.event.on("beforeload", onBeforeLoad);
    navigate.event.on("load", onLoad);
    navigate.event.on("scroll", page.render);
    page.init();
});
