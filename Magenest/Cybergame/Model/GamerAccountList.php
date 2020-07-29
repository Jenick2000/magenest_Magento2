<?php
namespace Magenest\Cybergame\Model;
use Magento\Framework\Model\AbstractModel;
class GamerAccountList extends  AbstractModel {

    protected function _construct()
    {
        $this->_init('Magenest\Cybergame\Model\ResourceModel\GamerAccountList');
        parent::_construct();
    }
}