var config = {
    "shim": {
        "sarewebLib": [],
    },
    "paths": {
        "sarewebLib": "Fwc_SAREhub/sarewebLib"
    },
    config: {
        mixins: {
            'Magento_Checkout/js/action/select-shipping-method': {
                'Fwc_SAREhub/js/action/select-shipping-method-mixin': true
            },
            'Magento_Checkout/js/action/select-payment-method': {
                'Fwc_SAREhub/js/action/select-payment-method-mixin': true
            },
            'Magento_Checkout/js/action/place-order': {
                'Fwc_SAREhub/js/action/place-order-mixin': true
            },
            'Magento_Checkout/js/action/select-shipping-address': {
                'Fwc_SAREhub/js/action/select-shipping-address-mixin': true
            },
            'Magento_Checkout/js/model/step-navigator': {
                'Fwc_SAREhub/js/model/step-navigator-mixin': true
            }
        }
    }
};

require.config(config);

require([
    'sarewebLib'
], function($) {


});
