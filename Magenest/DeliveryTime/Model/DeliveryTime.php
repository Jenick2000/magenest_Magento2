<?php
namespace Magenest\DeliveryTime\Model;

class DeliveryTime extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface {
    const CACHE_TAG = 'magenest_delivery_time';

    protected $_cacheTag = 'magenest_delivery_time';

    protected $_eventPrefix = 'magenest_delivery_time';

    protected function _construct()
    {
        $this->_init('Magenest\DeliveryTime\Model\ResourceModel\DeliveryTime');
    }
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }
}
