<?php
namespace  Magenest\DeliveryTime\Model\ResourceModel;


class DeliveryTime extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    )
    {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('magenest_delivery_time', 'delivery_time_id');
    }

}
