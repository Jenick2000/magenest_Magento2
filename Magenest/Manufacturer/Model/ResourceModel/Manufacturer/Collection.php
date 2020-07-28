<?php

namespace Magenest\Manufacturer\Model\ResourceModel\Manufacturer;

use  Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    protected function _construct()
    {
        $this->_init('Magenest\Manufacturer\Model\Manufacturer', 'Magenest\Manufacturer\Model\ResourceModel\Manufacturer');
        parent::_construct();

    }
}