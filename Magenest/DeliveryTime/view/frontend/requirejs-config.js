var config = {
    config: {
        mixins: {
            'Magento_Checkout/js/action/set-shipping-information': {
                'Magenest_DeliveryTime/js/action/set-shipping-information-mixin': true
            },
            'Magento_Checkout/js/model/shipping-save-processor/payload-extender': {
                'Magenest_DeliveryTime/js/model/payload-extender-mixin': true
            },
            'Magento_Checkout/js/model/address-converter': {
                'Magenest_DeliveryTime/js/model/address-converter-mixin': true
            },
            'Magento_Checkout/js/view/payment/default': {
                'Magenest_DeliveryTime/js/view/payment/default-mixin': true
            },
        }
    }
};