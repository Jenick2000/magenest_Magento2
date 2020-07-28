<?php

namespace Magenest\HotelBooking\Model\HotelProvider;

use Magenest\HotelBooking\Model\ResourceModel\Hotel\CollectionFactory;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    protected $collection;
    protected $_loadedData;

    public function __construct($name, $primaryFieldName, $requestFieldName, CollectionFactory $collectionFactory, array $meta = [], array $data = [])
    {
        $this->collection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->_loadedData)) return $this->_loadedData;
        $items = $this->collection->getItems();
        foreach ($items as $item) {
            $this->_loadedData[$item->getHotelId()] = $item->getData();
        }
        return $this->_loadedData;
    }
}