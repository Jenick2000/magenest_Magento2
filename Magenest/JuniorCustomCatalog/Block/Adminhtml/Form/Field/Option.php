<?php

namespace Magenest\JuniorCustomCatalog\Block\Adminhtml\Form\Field;

class Option implements \Magento\Framework\Data\OptionSourceInterface
{

    public function toOptionArray()
    {
        return [['value' => 1, 'label' => __('Enabled')], ['value' => 0, 'label' => __('Disabled')]];
    }
}