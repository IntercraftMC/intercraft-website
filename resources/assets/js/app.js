
/**
 * First we will load all of this project"s JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

require("./event_queue");
require("./navigation");

require("./components");
require("./loading");
require("./navbar");
require("./page");
require("./particles");

const prebody = new Vue({
    el: "#prebody"
});

var onBeforeLoad = function () {
    loading.activate($("#loading-logo"));
};

var onLoad = function () {
    loading.deactivate($("#loading-logo"));
};

/**
 * Render the web page on load
 */
$(document).ready(function () {
    navigate.init();
    navigate.event.on("beforeload", onBeforeLoad);
    navigate.event.on("load", onLoad);
    page.renderInitial();
});
