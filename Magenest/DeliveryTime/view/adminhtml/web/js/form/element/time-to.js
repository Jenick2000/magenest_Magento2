define([
    'Magento_Ui/js/form/element/select'
], function (Select) {
    'use strict';

    return Select.extend({
        initialize: function () {
            this._super()
            return this;
        },
        onUpdate: function (value) {
            let self = this;
            let recordId = this.containers[0].recordId;
            let timeRecord = this.source.data.times[recordId];
            self.validation['deliveryTimeTo'] = false;

            if(parseInt(timeRecord.time_from) > parseInt(value)) {
                self.validation['deliveryTimeTo'] = true;
            }
        }
    });
});
