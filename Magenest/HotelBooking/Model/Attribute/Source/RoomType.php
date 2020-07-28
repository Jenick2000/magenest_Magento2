<?php

namespace Magenest\HotelBooking\Model\Attribute\Source;

class RoomType extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{

    public function getAllOptions()
    {

        if (!$this->_options) {
            $option = [
                ['label' => __('-- Choose Type --'), 'value' => ''],
                ['label' => __('Single'), 'value' => 'single'],
                ['label' => __('Double'), 'value' => 'double'],
                ['label' => __('Triple'), 'value' => 'triple'],
            ];

            $this->_options = $option;
        }
        return $this->_options;
    }
}