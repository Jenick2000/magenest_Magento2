define([
    'ko',
    'jquery',
    'uiComponent',
    'mage/url',
], function (ko, $, Component, urlBuilder) {
    'use strict';
    var id = 1;

     return Component.extend({

        defaults: {
            template: 'Magenest_Movie/test',
        },
        productList: ko.observableArray([]),
        isLoading: ko.observable(false),
        getProduct: function () {
            var self = this;
            var serviceUrl = urlBuilder.build('magenest/test/product?id=' + id);
            id++;
            self.isLoading(true);
            $.get(serviceUrl, function (data, status) {
                self.productList.push(JSON.parse(data));
                self.isLoading(false);
            });
        },
    });

});