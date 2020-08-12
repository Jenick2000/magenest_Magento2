define([
    'Magento_Ui/js/form/element/date'
], function (Date) {
    let availableDates = [12, 13, 14, 15];
    return Date.extend({

        defaults: {
            options: {
                beforeShowDay: function (d) {
                    var date = d.getDate();
                    if (availableDates.indexOf(date) >= 0) {
                        return [true, "", "Available"];
                    } else {
                        return [false, "", "unAvailable"];
                    }
                },
            }
        },
    });

});