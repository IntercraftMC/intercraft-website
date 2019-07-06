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
 * Reference to Axios method to cancel active request
 */
var cancelLoading = null;

/**
 * The configuration for Axios
 */
const AXIOS_CONFIG = {
    cancelToken: new axios.CancelToken((c) => {
        cancel = c;
    })
};

/**
 * Map of all registered components for local navigation
 */
var componentMap = {};

/**
 * Store the current page state
 */
var pageState = {};

/**
 * Pop a state off of the history stack
 */
var popState = function (state) {
    let ticket = {
        componentKey: pageState.componentKey,
        pushState   : false,
        url         : state.url
    };
    // Check if going forward instead of back
    if (state.timestamp > pageState.timestamp) {
        ticket.componentKey = state.componentKey;
    }
    pageState.title        = state.title;
    pageState.url          = state.url;
    pageState.componentKey = state.componentKey;
    pageState.timestamp    = state.timestamp;
    request(ticket);
};

/**
 * Push a new state onto the history stack
 */
var pushState = function (state) {
    pageState.title        = state.title;
    pageState.url          = state.url;
    pageState.componentKey = state.componentKey;
    pageState.timestamp    = state.timestamp || utils.getMilliseconds();
    if (cancelLoading) {
        history.replaceState(pageState, pageState.title, pageState.url);
    } else {
        history.pushState(pageState, pageState.title, pageState.url);
    }
};

/**
 * Replace the current state on the history stack
 */
var replaceState = function (state) {
    pageState.title        = state.title;
    pageState.url          = state.url;
    pageState.componentKey = state.componentKey;
    pageState.timestamp    = (history.state || {}).timestamp || state.timestamp || utils.getMilliseconds();
    history.replaceState(pageState, pageState.title, pageState.url);
};

/**
 * Create and set the state for the next request
 */
var setRequestState = function (ticket) {
    if (!ticket.pushState) {
        return;
    }
    let state = {
        componentKey: ticket.componentKey,
        title       : pageState.title,
        url         : ticket.url
    };
    if (cancelLoading) {
        replaceState(state);
    } else {
        pushState(state);
    }
};

/**
 * Create and send an Ajax request
 */
var request = function (ticket) {
    // Resort to standard navigation if Ajax navigation is not supported
    if (!history.pushState) {
        location.assign(ticket.url);
        return;
    }
    setRequestState(ticket);
    navigate.abort();
    sendRequest(ticket);
};

/**
 * Request a webpage
 */
var sendRequest = function (ticket) {
    if (!onBeforeLoad(ticket)) {
        return;
    }
    axios.get(ticket.url, AXIOS_CONFIG)
    .then(response => onLoad(ticket, response))
        .catch(error => onError(ticket, error))
        .then(() => onFinish(ticket));
};

/**
 * Invoked before a navigation Ajax request is sent
 */
var onBeforeLoad = function (ticket) {
    if (ticket.componentKey in componentMap) {
        if (componentMap[ticket.componentKey].onNavigateBeforeLoad) {
            componentMap[ticket.componentKey].onNavigateBeforeLoad(ticket);
        }
    } else {
        eventEmitter.emit("beforeload", ticket.url);
    }
    return true;
};

/**
 * Invoked when a navigation Ajax response is received
 */
var onLoad = function (ticket, response) {
    if (ticket.componentKey in componentMap) {
        if (componentMap[ticket.componentKey].onNavigateLoad) {
            componentMap[ticket.componentKey].onNavigateLoad(response);
        }
    } else {
        onPageLoaded(ticket, response);
    }
};

/**
 * Invoked after a navigation Ajax request is completed
 */
var onFinish = function (ticket) {
    if (ticket.componentKey in componentMap) {
        if (componentMap[ticket.componentKey].onNavigateFinish) {
            componentMap[ticket.componentKey].onNavigateFinish();
        }
    } else {
        eventEmitter.emit("load");
    }
};

/**
 * Invoked after a navigation Ajax request has errored
 */
var onError = function (ticket, error) {
    if (ticket.componentKey in componentMap) {
        if (componentMap[ticket.componentKey].onNavigateError) {
            componentMap[ticket.componentKey].onNavigateError(error);
        }
    } else {
        eventEmitter.emit("error", error, HTTP_STATUS[error.response.status]);
        console.error("Navigation Error: ", err, {
            request: err.request,
            response: err.response
        });
    }
};

/**
 * Invoked when the page is loaded
 */
var onPageLoaded = function (ticket, response) {
    pageState.title = response.data.title;
    replaceState(pageState);
    page.set(response.data.title, response.data.header, response.data.view);
};

/**
 * Create the listeners for links
 */
var initLinkListeners = function () {
    $(document).on("click", "a[href]", function (event) {
        if (EXP.test($(this).attr("href"))) {
            onNavigate(this);
            event.preventDefault();
        }
    });
};

/**
 * Invoked when a local link is activated
 */
var onNavigate = function (elem) {
    navigate.to($(elem).attr("href"));
};

/**
 * Invoked when the browser pops a state off of the history stack
 */
var onPopState = function (event) {
    if (event.originalEvent.state) {
        // Don't request new pages if only the hash changes
        let newHash     = (event.originalEvent.state.url.match(/#[^?]*/gi) || [""])[0];
        if (pageState.url.replace(/#[^?]*/gi, newHash) != event.originalEvent.state.URL) {
            popState(event.originalEvent.state);
        }
    }
};

/**
 * Invoked when the user scrolls in the application
 */
var onScroll = function () {
    eventEmitter.emit("scroll", $(window).scrollTop());
};

window.navigate = {

    /**
     * A reference to the event emitter
     */
    event: eventEmitter,

    /**
     * Abort the current load attempt
     */
    abort() {
        if (cancelLoading) {
            cancelLoading();
        }
    },

    /**
     * Go to the previous page via Ajax navigation
     */
    back() {
        history.back();
    },

    /**
     * Go forward to the next page via Ajax navigation
     */
    forward() {
        history.forward();
    },

    /**
     * Initialize the navigation module
     */
    init() {
        $(window).on("popstate", onPopState);
        $(window).scroll(onScroll);
        initLinkListeners();
        replaceState({
            componentKey: undefined,
            title       : document.title,
            url         : location.href
        });
    },

    /**
     * Check if there is an active Ajax request
     */
    isLoading() {
        return Boolean(cancelLoading);
    },

    /**
     * Navigate to a new URL via Ajax
     */
    to(url, parameters = {}, componentKey = null) {
        request({
            componentKey: componentKey,
            parameters  : parameters,
            pushState   : true,
            url         : url
        });
    },

    /**
     * Register a component for local navigation
     */
    registerComponent(component, key) {
        componentMap[key] = component;
    },

    /**
     * Unregister a component for local navigation
     */
    unregisterComponent(key) {
        delete componentMap[key];
    }
};
