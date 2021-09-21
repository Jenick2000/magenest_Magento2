/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
define([
    'Magento_Ui/js/form/element/date',
], function (Element) {
    'use strict';

    return Element.extend({
        defaults: {
            options: {
                showsDate: false,
                showsTime: true,
                timeOnly: true,
                timeFormat: 'h:mm a',
                dateFormat: 'MMM d, YYYY',
                currentText: 'Now',
                closeText: 'Done',
                }
        }
    });
});
