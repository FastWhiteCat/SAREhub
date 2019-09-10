define([
    'jquery',
    'Fwc_SAREhub/js/events-wrapper'
], function ($, eventsWrapper) {
    'use strict';

    return function (originalAction) {
        return eventsWrapper(['_cartdelivery'],originalAction);
    };
});
