/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

define([
    'ko',
    'jquery',
    'Magento_Ui/js/form/element/abstract'
], function (ko, $, Abstract) {
    'use strict';

    return Abstract.extend({
        defaults: {
            options: ko.observable([]),
            valueUpdate: 'input'
        },

        onUpdate: function (value) {
            if(value.length >= 3)
                this.getSuggestDocuments(value)
            else
                this.options([]);
        },

        getSuggestDocuments: function (document) {
            var self = this;
            $.ajax({
                url: this.ajaxUrl,
                type: 'get',
                data: {document: document}
            }).done(function (data) {
                if(data.items)
                    self.options(data.items);
                else
                    this.options([]);
            });
        },

        optionSelected: function (data, index, event) {
            $('.admin__action-document-menu-inner-item .item').removeClass('active');
            event.target.classList.toggle("active");
            this.source.data.product.document = data.file_id;
            $('input[name="product[document]"]').val(data.file_label);
        }
    });
});
