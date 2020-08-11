define([
    'Magento_Ui/js/form/element/date'
], function (Date) {
    return Date.extend({

        defaults: {
            options: {
                minDate: -2, //your input box date value.
                maxDate: 1

            }
        },
    });

});