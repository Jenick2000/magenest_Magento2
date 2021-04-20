/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

define([
    'jquery',
    'uiComponent',
    'ko',
    'mage/calendar',
    'mage/translate',
    'Magento_Customer/js/customer-data',
    'Magento_Customer/js/model/customer',
    'Magento_Customer/js/action/check-email-availability',
    'Magento_Customer/js/action/login',
    'Magento_Checkout/js/model/quote',
    'Magento_Checkout/js/checkout-data',
    'Magento_Checkout/js/model/full-screen-loader',
    'mage/validation'
], function ($, Component, ko, calendar, $t,storage, customer, checkEmailAvailability, loginAction, quote, checkoutData, fullScreenLoader) {
    'use strict';


    return Component.extend({
        defaults: {
            template: 'Magenest_DeliveryTime/shipping/additionalField',
        },
        deliveryDate: ko.observable(),
        deliveryTime: ko.observable(),
        deliveryComment: ko.observable(),

        /**
         * @return {exports}
         */
        initialize: function () {
            this._super();
            let customShippingData = storage.get('customShippingData')();
            if(!$.isEmptyObject(customShippingData)) {
                this.deliveryDate(customShippingData.delivery_date);
                this.deliveryTime(customShippingData.delivery_time);
                this.deliveryComment(customShippingData.delivery_comment);
            }
            this.deliveryDate.subscribe((value) => {
                customShippingData.delivery_date = value;
                storage.set('customShippingData', customShippingData);
            })
            this.deliveryTime.subscribe((value) => {
                customShippingData.delivery_time = value;
                storage.set('customShippingData', customShippingData);
            })
            this.deliveryComment.subscribe((value) => {
                customShippingData.delivery_comment = value;
                storage.set('customShippingData', customShippingData);
            })
        return this;
        },
        /**
         * Initializes regular properties of instance.
         *
         * @returns {Object} Chainable.
         */
        initConfig: function () {
            this._super();

            return this;
        },

        /**
         * Initializes observable properties of instance
         *
         * @returns {Object} Chainable.
         */
        initObservable: function () {

            return this;
        },
        datePicker: function (element) {

            let config = this.getConfig();
            $(element).calendar({
                changeMonth: true,
                changeYear: false,
                showButtonPanel: true,
                currentText: $t('Go Today'),
                closeText: $t('Close'),
                showWeek: true,
                dateFormat: "mm/dd/yy",
                minDate: config.minimal_delivery_interval,
                maxDate: config.maximal_delivery_interval,
                //beforeShowDay: true
            });
        },
        getConfig: function () {
            return window.checkoutConfig.deliveryTime;
        },
        getDeliveryTimes: function () {
            let config = this.getConfig();

            return config.deliveryTimeOptions;
        }

    });
});
