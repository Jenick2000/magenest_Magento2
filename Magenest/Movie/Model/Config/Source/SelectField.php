<?php

namespace Magenest\Movie\Model\Config\Source;

class SelectField implements  \Magento\Framework\Option\ArrayInterface{

    public function toOptionArray()
    {
        // TODO: Implement toOptionArray() method.
        return [['value' => 1, 'label' => __('Show')], ['value' => 0, 'label' => __('Not Show')]];
    }
}