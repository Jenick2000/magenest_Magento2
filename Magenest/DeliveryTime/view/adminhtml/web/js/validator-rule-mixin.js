define([
    'jquery',
    'Magento_Ui/js/lib/validation/utils',
], function ($, utils) {
    'use strict';

    return function (validator) {

        validator.addRule(
            'deliveryTimeTo',
            function (value) {
                return false;
            },
            $.mage.__('Invalid delivery time to, time to must >= time from !')
        );
        validator.addRule(
            'deliveryTimeFrom',
            function (value) {
                return false;
            },
            $.mage.__('Invalid data, time from must <= time to !')
        );

        return validator;
    };
});
