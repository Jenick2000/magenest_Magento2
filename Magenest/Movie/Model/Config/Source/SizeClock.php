<?php

namespace Magenest\Movie\Model\Config\Source;
class SizeClock implements \Magento\Framework\Option\ArrayInterface
{

    public function toOptionArray()
    {
        return [
            ['value' => 80, 'label' => __('Small')],
            ['value' => 100, 'label' => __('Minium')],
            ['value' => 150, 'label' => __('Large')]
        ];
    }
}