<?php
namespace Learning\FirstUnit\Model\ResourceModel;

class Subscription extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb {
    public function _construct()
    {
        // TODO: Implement _construct() method.
        $this->_init('learning_firstunit_subscription','subscription_id' );
    }
}