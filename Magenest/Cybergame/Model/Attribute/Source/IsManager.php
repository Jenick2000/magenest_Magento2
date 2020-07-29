<?php

namespace Magenest\Cybergame\Model\Attribute\Source;

class IsManager extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{

    public function getAllOptions()
    {
        if (!$this->_options) {
            $this->_options = [
                ['label' => __('No'), 'value' => '0'],
                ['label' => __('Yes'), 'value' => '1']
            ];
        }
        return $this->_options;
    }
}