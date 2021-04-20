<?php


namespace Magenest\DeliveryTime\Plugin\Checkout;


/**
 * Class LayoutProcessorPlugin
 * @package Magenest\SocialLogin\Plugin\Checkout
 */
class LayoutProcessorPlugin
{
    /**
     * @param \Magento\Checkout\Block\Checkout\LayoutProcessor $subject
     * @param array $jsLayout
     * @return array
     */
    public function afterProcess(
        \Magento\Checkout\Block\Checkout\LayoutProcessor $subject,
        array  $jsLayout
    ) {
        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
        ['shippingAddress']['children']['shippingAdditional'] = [
            'component'   => 'Magenest_DeliveryTime/js/shipping/additional-field',
            'displayArea' => 'shippingAdditional',
            'children'    => []
        ];

        return $jsLayout;
    }
}
