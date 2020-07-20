<?php

namespace Learning\FirstUnit\Model\Config\Source;

class Relation implements  \Magento\Framework\Data\OptionSourceInterface {

    public function toOptionArray()
    {
        // TODO: Implement toOptionArray() method.
        return [
            [
                'value' => null,
                'label' => __('--Please Select--')
            ],
            [
                'value' => 'bronze',
                'label' => __('Bronze')
            ],
            [
                'value' => 'silver',
                'label' => __('Silver')
            ],
            [
                'value' => 'gold',
                'label' => __('Gold')
            ],
        ];

    }
}