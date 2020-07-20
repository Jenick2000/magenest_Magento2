<?php
namespace Magenest\Movie\Model\DirectorProvider;

use Magenest\Movie\Model\ResourceModel\Director\CollectionFactory;

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
            $this->_loadedData[$item->getDirectorId()] = $item->getData();
        }
        return $this->_loadedData;


    }

}