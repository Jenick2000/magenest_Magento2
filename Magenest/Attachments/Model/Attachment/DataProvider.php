<?php

namespace Magenest\Attachments\Model\Attachment;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Magenest\Attachments\Model\ResourceModel\Attachments\CollectionFactory;
use Magento\Framework\Serialize\Serializer\Json;

class DataProvider extends AbstractDataProvider {

    /**
     * @var \Magento\Framework\Registry
     */
    protected $coreRegistry;

    /**
     * @var Json
     */
    protected $serialize;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $menuColFactory,
        \Magento\Framework\Registry $registry,
        Json $serialize,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $menuColFactory->create();
        $this->coreRegistry = $registry;
        $this->serialize = $serialize;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();
        $this->loadedData = array();

        foreach ($items as $item) {
            if(!empty($item->getPath())) {
                $file = $this->serialize->unserialize($item->getPath());
                $item->setData('path', $file );
                $item->setData('file_extension', $this->getExtensionFile($file[0]));
            }
            $this->loadedData[$item->getId()] = $item->getData();
        }

        return $this->loadedData;
    }

    /**
     * @param array $file
     * @return mixed|string
     */
    public function getExtensionFile( array $file) {
        if(isset($file['type'])){
            $extension = explode('/', $file['type']);
            if(isset($extension[1]))
                return $extension[1];
            return $file['type'];
        }
        return '';
    }

}
