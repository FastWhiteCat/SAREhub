define([
    'jquery',
    'mage/url',

], function ($, url) {
    'use strict';

    return  {
        getSareAjaxData: function () {
            var response = '',
                dataProviderUrl = window.location.origin + '/sarehub/dataprovider/index';

            $.ajax({
                url: dataProviderUrl,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    response = data;
                },
                error: function(request, error) {
                    console.log(error);
                },
                async: false, //todo::promise or sth
            });

            return response;
        },

        isEventAvailable: function (eventId) {
            let configData = this.getSareAjaxData();

            if (configData === '') {
                return false
            }

            return configData.events[eventId];
        },

        getData: function (eventId, eventObject) {
            let configData = this.getSareAjaxData();

            if (configData === '') {
                return false
            }

            var eventParams = {
                '_userId': configData.additionalData.userId,
                '_email': configData.additionalData.email,
                [eventId]: {
                    'cart_id': configData.additionalData.cart_id
                }
            };

            if (eventId === '_cartinitialized'
                || eventId === '_cartregistration'
                || eventId === '_cartdelivery'
                || eventId === '_cartpayment'
                || eventId === '_cartsummary'
                || eventId === '_cartconfirm'
                || eventId === '_cartpurchased'
            ) {
                return eventParams;
            }

            eventParams[eventId]['language'] = configData.additionalData.language;
            eventParams[eventId]['country'] = configData.additionalData.country;

            if (eventId === '_cartquantity') {
                eventParams[eventId]['product_id'] = eventObject.items[0].product_id;
                eventParams[eventId]['quantity'] = eventObject.items[0].qty;
            } else if (eventId === '_cartadd') {
                eventParams[eventId]['product_id'] = eventObject.items.product_id;
                eventParams[eventId]['quantity'] = eventObject.qty;
                eventParams[eventId]['url'] = eventObject.items.product_url;
            } else if (eventId === '_cartdel') {
                eventParams[eventId]['product_id'] = eventObject.items[0].product_id;
            }

            return eventParams;
        }
    };
});
