
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 require('./components');
 require('./loading');
 require('./navbar');
 require('./navigation');
 require('./page');

const nav = new Vue({
    el: 'nav'
});

Pace.on("start", function () {
    console.log("Started");
    loading.activate(".loading-logo");
});
Pace.on("done", function () {
    console.log("Done");
    loading.deactivate(".loading-logo");
});
Pace.start();

/**
 * Render the web page on load
 */
$(document).ready(function () {
    navigate.init();
    page.render();
});
