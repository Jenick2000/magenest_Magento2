<?php
namespace Learning\FirstUnit\Model\Subscription;

use Learning\FirstUnit\Model\ResourceModel\Subscription\CollectionFactory;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider {


    protected $collection;
    protected $_loadedData;
    public function __construct($name, $primaryFieldName, $requestFieldName,CollectionFactory $SubscriptionCollectionFactory , array $meta = [], array $data = [])
    {
        $this->collection = $SubscriptionCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if(isset($this->_loadedData)) return $this->_loadedData;
        $items = $this->collection->getItems();

        foreach ($items as $subs) {
            $this->_loadedData[$subs->getSubscription_id()] = $subs->getData();
        }

        return $this->_loadedData;


    }
}

