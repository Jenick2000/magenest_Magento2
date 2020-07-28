<?php

namespace Magenest\HotelBooking\Model;

use Magento\Framework\Model\AbstractModel;

class Hotel extends AbstractModel
{

    protected function _construct()
    {
        $this->_init('Magenest\HotelBooking\Model\ResourceModel\Hotel');
        parent::_construct();
    }
}