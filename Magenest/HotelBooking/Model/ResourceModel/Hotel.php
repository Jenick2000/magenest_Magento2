<?php

namespace Magenest\HotelBooking\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Hotel extends AbstractDb
{

    protected function _construct()
    {
        // TODO: Implement _construct() method.
        $this->_init('hotel', 'hotel_id');
    }
}