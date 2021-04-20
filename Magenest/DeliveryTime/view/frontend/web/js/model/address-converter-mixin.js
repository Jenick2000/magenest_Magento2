
define([
    'jquery',
    'underscore',
    'mage/translate',
    'Magento_Customer/js/customer-data',
], function ($, _, $t, storage) {
    'use strict';

    return function (addressConverter) {
        var originFunction = addressConverter.formAddressDataToQuoteAddress.bind(addressConverter);

        return _.extend(addressConverter, {
            formAddressDataToQuoteAddress: function (formData) {
                let address = originFunction(formData);
                let customShippingData = storage.get('customShippingData')();
                if (address['customAttributes'] === undefined) {
                    address['customAttributes'] = [];
                }
                let index = 0;
                if(address['customAttributes'])
                    index = address['customAttributes'].length;

                Object.entries(customShippingData).forEach(([key, value]) => {
                    address['customAttributes'][index] = {attribute_code: key, value: value};
                    index++;
                });


                return address;
            }
        })
    };
});