<?php
namespace Magenest\Cybergame\Model;

use Magento\Framework\Model\AbstractModel;

class RoomExtraOption extends AbstractModel{

    protected function _construct()
    {
        $this->_init('Magenest\Cybergame\Model\ResourceModel\RoomExtraOption');
        parent::_construct();
    }
}