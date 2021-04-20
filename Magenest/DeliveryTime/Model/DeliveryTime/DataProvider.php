<?php
namespace Magenest\DeliveryTime\Model\DeliveryTime;

use Magenest\DeliveryTime\Model\ResourceModel\DeliveryTime\CollectionFactory;
use Magento\Framework\Serialize\Serializer\Json;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var \Magento\Framework\Registry
     */
    protected $coreRegistry;
    /**
     * @var Json
     */
    protected $serializer;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $deliveryTimeColFactory,
        \Magento\Framework\Registry $registry,
        Json $serializer,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $deliveryTimeColFactory->create();
        $this->coreRegistry = $registry;
        $this->serializer = $serializer;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();
        $this->loadedData = array();

        foreach ($items as $deliveryTime) {

            $deliveryTime->setTimes($this->serializer->unserialize($deliveryTime->getTimes()));
            $customerGroupIds =  str_replace('"', "", $deliveryTime->getCustomerGroupId());
            $stores = str_replace('"', "", $deliveryTime->getStoreId());
            $deliveryTime->setStoreId($stores);
            $deliveryTime->setCustomerGroupId($customerGroupIds);

            $this->loadedData[$deliveryTime->getId()] = $deliveryTime->getData();
        }

        return $this->loadedData;
    }
}
