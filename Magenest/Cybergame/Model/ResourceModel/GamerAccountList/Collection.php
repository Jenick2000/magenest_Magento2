<?php

namespace Magenest\Cybergame\Model\ResourceModel\GamerAccountList;

use  Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    protected function _construct()
    {
        $this->_init('Magenest\Cybergame\Model\GamerAccountList', 'Magenest\Cybergame\Model\ResourceModel\GamerAccountList');
        parent::_construct();
    }
}