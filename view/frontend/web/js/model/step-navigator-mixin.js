define([
    'jquery',
    'mage/utils/wrapper',
    'Fwc_SAREhub/js/multi-events-handler'
], function ($, wrapper, multiEventsHandler) {
    'use strict';
    return function(stepNavigator){
        stepNavigator.next = wrapper.wrap(stepNavigator.next, function(originalNext){
            multiEventsHandler(['_cartconfirm', '_cartsummary']);

            return originalNext();
        });

        return stepNavigator;
    };
});
