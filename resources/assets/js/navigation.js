const EventEmitter = require("events");

/**
 * HTTP status codes
 */
const HTTP_STATUS = {
    100: "Continue",
    101: "Switching Protocols",
    102: "Processing",
    200: "OK",
    201: "Created",
    202: "Accepted",
    203: "Non-Authoritative Information",
    204: "No Content",
    205: "Reset Content",
    206: "Partial Content",
    207: "Multi-Status",
    208: "Already Reported",
    226: "IM Used",
    300: "Multiple Choices",
    301: "Moved Permanently",
    302: "Found",
    303: "See Other",
    304: "Not Modified",
    305: "Use Proxy",
    306: "Reserved",
    307: "Temporary Redirect",
    308: "Permanent Redirect",
    400: "Bad Request",
    401: "Unauthorized",
    402: "Payment Required",
    403: "Forbidden",
    404: "Not Found",
    405: "Method Not Allowed",
    406: "Not Acceptable",
    407: "Proxy Authentication Required",
    408: "Request Timeout",
    409: "Conflict",
    410: "Gone",
    411: "Length Required",
    412: "Precondition Failed",
    413: "Request Entity Too Large",
    414: "Request-URI Too Long",
    415: "Unsupported Media Type",
    416: "Requested Range Not Satisfiable",
    417: "Expectation Failed",
    422: "Unprocessable Entity",
    423: "Locked",
    424: "Failed Dependency",
    425: "Unassigned",
    426: "Upgrade Required",
    427: "Unassigned",
    428: "Precondition Required",
    429: "Too Many Requests",
    430: "Unassigned",
    431: "Request Header Fields Too Large",
    500: "Internal Server Error",
    501: "Not Implemented",
    502: "Bad Gateway",
    503: "Service Unavailable",
    504: "Gateway Timeout",
    505: "HTTP Version Not Supported",
    506: "Variant Also Negotiates (Experimental)",
    507: "Insufficient Storage",
    508: "Loop Detected",
    509: "Unassigned",
    510: "Not Extended",
    511: "Network Authentication Required"
};

/**
 * A regular expression to test local links
 */
const EXP = new RegExp(location.host);

/**
 * The event emitter
 */
var eventEmitter = new EventEmitter();

/**
 * Ajax information
 */
var cancel    = null;
var isLoading = false;

/**
 * Page information
 */
var pageInfo = {
    title: document.title,
    url  : location.href
};

/**
 * The configuration for Axios
 */
var AXIOS_CONFIG = {
    cancelToken: new axios.CancelToken((c) => {
        cancel = c;
    })
};

/**
 * Create the listeners for links
 */
var initLinkListeners = function () {
    $(document).on("click", "[href]", function (event) {
        if (EXP.test($(this).attr("href"))) {
            onLinkClick(this);
            event.preventDefault();
        }
    });
};

/**
 * Request a page
 */
var requestPage = function (url, pushState = false) {
    if (!history.pushState) {
        location.assign(url);
        return;
    }
    if (isLoading) {
        return;
    }
    // if ()
    isLoading    = true;
    pageInfo.url = url;
    eventEmitter.emit("beforeload");
    axios.get(url, AXIOS_CONFIG)
        .then((response) => { onAjaxLoad(response, url, pushState); })
        .catch(onAjaxError)
        .then(() => {
            isLoading = false;
            eventEmitter.emit("load");
        });
};

/**
 * Invoked when an error occurs
 */
var onAjaxError = function (err) {
    console.error("Navigation Error: ", err, {
        request : err.request,
        response: err.response
    });
};

/**
 * Invoked when the Ajax completed successfully
 */
var onAjaxLoad = function (response, url, pushState) {
    pageInfo.title = response.data.title;
    if (pushState) {
        history.pushState(pageInfo, response.data.title, url);
    }
    page.set(response.data.title, response.data.header, response.data.view);
};

/**
 * Invoked when a link is clicked
 */
var onLinkClick = function (elem) {
    navigate.to($(elem).attr("href"));
};

/**
 * Invoked when the browser pops a state off of the history stack
 */
var onPopState = function (event) {
    if (event.originalEvent.state) {
        // Don't request new pages if only the hash changes
        let newHash = (document.URL.match(/#[^?]*/gi) || [""])[0];
        if (pageInfo.url.replace(/#[^?]*/gi, newHash) != document.URL) {
            pageInfo.title = event.originalEvent.state.title;
            pageInfo.url   = event.originalEvent.state.url;
            requestPage(pageInfo.url, false);
        }
    }
};

/**
 * Invoked when the user scrolls in the application
 */
var onScroll = function () {
    eventEmitter.emit("scroll", $(window).scrollTop());
};

/**
 * Navigation module
 */
window.navigate = {

    /**
     * Store the event emitter
     */
    event: eventEmitter,

    /**
     * Initialize the navigation system
     */
    init () {
        initLinkListeners();
        $(window).on("popstate", onPopState);
        $(window).scroll(onScroll);
        history.replaceState(pageInfo, pageInfo.title, pageInfo.url);
        onScroll();
    },

    /**
     * Cancel the current navigation attempt
     */
    abort () {
        if (cancel)
            cancel();
    },

    /**
     * Go to a URL via Ajax
     */
    to (url) {
        requestPage(url, true);
    }
};
