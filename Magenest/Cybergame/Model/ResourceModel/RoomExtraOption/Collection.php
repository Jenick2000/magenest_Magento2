<?php

namespace Magenest\Cybergame\Model\ResourceModel\RoomExtraOption;

use  Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Magenest\Cybergame\Model\RoomExtraOption', 'Magenest\Cybergame\Model\ResourceModel\RoomExtraOption');
        parent::_construct();
    }
}
