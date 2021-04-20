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
class OffTime implements \Magento\Framework\Option\ArrayInterface
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
            ['value' => 1, 'label' => __('Sunday')],
            ['value' => 2, 'label' => __('Monday')],
            ['value' => 3, 'label' => __('Tuesday')],
            ['value' => 4, 'label' => __('Wednesday')],
            ['value' => 5, 'label' => __('Thursday')],
            ['value' => 6, 'label' => __('Friday')],
            ['value' => 7, 'label' => __('Saturday')],
        );

        return $options;
    }
}
