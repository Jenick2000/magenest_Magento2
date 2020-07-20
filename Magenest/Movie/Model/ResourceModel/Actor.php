<?php
 namespace Magenest\Movie\Model\ResourceModel;
 use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

 class Actor extends AbstractDb {

     protected function _construct()
     {
         // TODO: Implement _construct() method.
         $this->_init('magenest_actor', 'actor_id');
     }
 }