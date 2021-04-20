define([
    'jquery',
    'mage/utils/wrapper',
    'Magento_Checkout/js/model/quote',
    'Magento_Customer/js/customer-data'
], function ($, wrapper, quote, storage) {
    'use strict';

    return function (setShippingInformationAction) {

        return wrapper.wrap(setShippingInformationAction, function (originalAction) {
            var shippingAddress = quote.shippingAddress();
            if (shippingAddress['customAttributes'] === undefined) {
                shippingAddress['customAttributes'] = [];
            }
            let customShippingData = storage.get('customShippingData')();
            shippingAddress['customAttributes'] = shippingAddress['customAttributes'].filter((item) => {
                        return !customShippingData[item.attribute_code];
                });
            let index = shippingAddress['customAttributes'].length;
            Object.entries(customShippingData).forEach(([key, value]) => {
                shippingAddress['customAttributes'][index] = {attribute_code: key, value: value};
                index++;
            });

            // pass execution to original action ('Magento_Checkout/js/action/set-shipping-information')
            return originalAction();
        });
    };
});