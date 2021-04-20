define(['Magento_Customer/js/customer-data'],
    function (storage) {
    'use strict';

    var mixin = {

        afterPlaceOrder: function () {
            storage.set('customShippingData', {});
           this._super();
        }
    };

    return function (target) {
        return target.extend(mixin);
    };
});