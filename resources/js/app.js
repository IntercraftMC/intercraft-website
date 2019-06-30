/**
 * Include dependencies
 */
require('./bootstrap');

/**
 * Ajax Navigation
 */
require('./navigation');

/**
 * Page Rendering
 */
require('./page');

/**
 * Utility functions
 */
require('./utils');

/**
 * Load Vue components
 */
const files = require.context('./', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

/**
 * Initialize Ajax navigation and page rendering
 */
navigate.init();
page.init();
