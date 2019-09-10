define([
    'Fwc_SAREhub/js/events-handler'
], function (eventsHandler) {
    'use strict';

    return function (eventIds) {
        eventIds.forEach(function (eventId) {
            eventsHandler(eventId);
        });
    };
});
