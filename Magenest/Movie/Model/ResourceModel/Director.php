<?php

namespace Magenest\Movie\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Director extends AbstractDb {

    protected function _construct()
    {
        // TODO: Implement _construct() method.
        $this->_init('magenest_director', 'director_id');
    }
}
