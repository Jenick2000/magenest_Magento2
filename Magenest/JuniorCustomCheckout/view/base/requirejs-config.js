var config = {
    'config': {
        'mixins': {
            'Magento_Checkout/js/view/shipping': {
                'Magenest_JuniorCustomCheckout/js/view/shipping-payment-mixin': true
            },
            'Magento_Checkout/js/view/payment': {
                'Magenest_JuniorCustomCheckout/js/view/shipping-payment-mixin': true
            }
        }
    }
}
