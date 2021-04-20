<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magenest\DeliveryTime\Model\Config\Source;

/**
 * Options provider for countries list
 *
 * @api
 * @since 100.0.2
 */
class DisplayInto implements \Magento\Framework\Data\OptionSourceInterface
{

    /**
     * Return options array
     *
     * @param boolean $isMultiselect
     * @param string|array $foregroundCountries
     * @return array
     */
    public function toOptionArray($isMultiselect = false, $foregroundCountries = '')
    {
        $options = array(
            ['value' => 'order_view_backend', 'label' => __('Order View Page (Backend)')],
            ['value' => 'order_action_backend', 'label' => __('New/Edit/Reorder Order Page (Backend)')],
            ['value' => 'invoice_view_backend', 'label' => __('Invoice View Page (Backend)')],
            ['value' => 'shipping_view_backend', 'label' => __('Shipping View Page (Backend)')],
            ['value' => 'order_info_frontend', 'label' => __('Order Info Page (Frontend)')],
        );

        return $options;
    }
}
