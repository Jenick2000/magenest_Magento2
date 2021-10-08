/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

define([
    'uiComponent',
    'jquery'
], function (Component, $) {
    'use strict';

    return Component.extend({

        /**
         * Prepare the product name value to be rendered as HTML
         *
         * @param {String} productName
         * @return {String}
         */
        getProductNameUnsanitizedHtml: function (productName) {
            // product name has already escaped on backend
            return productName;
        },

        /**
         * Prepare the given option value to be rendered as HTML
         *
         * @param {String} optionValue
         * @return {String}
         */
        getOptionValueUnsanitizedHtml: function (optionValue) {
            // option value has already escaped on backend
            return optionValue;
        },

        incrementQty: function (cartItem) {
            let qty = parseInt($(cartItem).val()) + 1;
            $(cartItem).val( qty);
        },
        decrementQty: function (cartItem) {
            let qty = parseInt($(cartItem).val()) - 1;
            $(cartItem).val( qty);
        },
    });
});
