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
class DateFormat implements \Magento\Framework\Data\OptionSourceInterface
{
    protected $timezone;

    public function __construct(\Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezone)
    {
        $this->timezone = $timezone;
    }

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
            ['value' => 'yyyy-mm-dd', 'label' => __('yyyy-mm-dd (2021-04-25)')],
            ['value' => 'mm/dd/yyyy', 'label' => __('mm/dd/yyyy (04/25/2021)')],
            ['value' => 'dd/mm/yyyy', 'label' => __('dd/mm/yyyy (25/04/2021)')],
            ['value' => 'd/m/yy', 'label' => __('d/m/yy (25/04/21)')]

        );

        return $options;
    }
}
