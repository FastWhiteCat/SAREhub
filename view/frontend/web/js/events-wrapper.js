define([
    'jquery',
    'mage/utils/wrapper',
    'Fwc_SAREhub/js/events-handler'
], function ($, wrapper, eventsHandler) {
    'use strict';

    return function (eventIds, originalMethod) {
        return wrapper.wrap(originalMethod, function (originalAction) {
            eventIds.forEach(function (eventId) {
                eventsHandler(eventId);
            });

            return originalAction();
        });
    };
});
