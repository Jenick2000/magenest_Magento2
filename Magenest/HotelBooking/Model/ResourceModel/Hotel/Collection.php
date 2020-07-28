<?php

namespace Magenest\HotelBooking\Model\ResourceModel\Hotel;

use  Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'hotel_id';

    protected function _construct()
    {
        parent::_construct();
        $this->_init('Magenest\HotelBooking\Model\Hotel', 'Magenest\HotelBooking\Model\ResourceModel\Hotel');
    }
}