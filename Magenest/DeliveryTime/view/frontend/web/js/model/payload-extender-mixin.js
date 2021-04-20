define([
    'jquery',
    'mage/utils/wrapper',
    'Magento_Customer/js/customer-data',
], function ($, wrapper, storage) {
    'use strict';

    return function (setExtensionAttributes) {
        return wrapper.wrap(setExtensionAttributes, function (originalAction, payload) {

            let customShippingData = storage.get('customShippingData')();
            if(!payload.addressInformation['extension_attributes']) {
                payload.addressInformation['extension_attributes'] = {};
            }
            if(!$.isEmptyObject(customShippingData)) {
                Object.entries(customShippingData).forEach(([key, value]) => {
                    payload.addressInformation['extension_attributes'][key] = value;
                })
            }

        });
    };
});
