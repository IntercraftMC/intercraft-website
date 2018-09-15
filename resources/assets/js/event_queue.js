

/**
 * This class controls events in a queue
 */
class EventQueue
{
    constructor () {
        this.__queue = new Set();
    }

    /**
     * Perform an action after an amount of delay
     */
    do (action, delay, ...params) {
        var tid = 0;
        var queue = this.__queue;
        var done = function () {
            queue.delete(tid);
        };
        tid = setTimeout(() => {
            action(this, ...params);
            done();
        }, delay);
        this.__queue.add(tid);
    }

    /**
     * Clear the current queue
     */
    clear () {
        this.__queue.forEach((key) => {
            clearTimeout(key);
        });
        this.__queue.clear();
    }

    /**
     * Number of items in the queue
     */
    length () {
        return this.__queue.size;
    }
};

window.EventQueue = EventQueue;
