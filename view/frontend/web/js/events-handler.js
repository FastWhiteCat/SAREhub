define([
    'jquery',
    'Fwc_SAREhub/js/data-provider'
], function ($, dataProvider) {
    'use strict';

    return function (eventId, dataObject = {}) {
        if (!dataProvider.isEventAvailable(eventId)) {
            return;
        }
        sareX_core.execute(10, dataProvider.getData(eventId, dataObject));
    };
});
