<?php
namespace Magenest\Cybergame\Model\ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
class GamerAccountList extends AbstractDb{

    protected function _construct()
    {
        $this->_init('gamer_account_list', 'id');
    }
}