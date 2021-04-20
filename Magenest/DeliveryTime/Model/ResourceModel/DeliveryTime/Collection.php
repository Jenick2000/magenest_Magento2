<?php
namespace Magenest\DeliveryTime\Model\ResourceModel\DeliveryTime;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'delivery_time_id';
    protected $_eventPrefix = 'magenest_delivery_time_collection';
    protected $_eventObject = 'delivery_time_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Magenest\DeliveryTime\Model\DeliveryTime', 'Magenest\DeliveryTime\Model\ResourceModel\DeliveryTime');
    }

}
