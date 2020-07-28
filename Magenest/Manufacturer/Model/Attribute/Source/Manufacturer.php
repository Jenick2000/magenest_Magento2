<?php

namespace Magenest\Manufacturer\Model\Attribute\Source;

use Magenest\Manufacturer\Model\ResourceModel\Manufacturer\CollectionFactory;

class Manufacturer extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    public function __construct(CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
    }

    public function getAllOptions()
    {
        $manufacturer = $this->collectionFactory->create();
        $allManufacturer = $manufacturer->getData();
        if (!$this->_options) {
            $option = [['label' => __('-- Choose Manufacturer --'), 'value' => '']];
            foreach ($allManufacturer as $manu) {
                $item = ['label' => $manu['name'], 'value' => $manu['manufacturer_id']];
                array_push($option, $item);
            }
            $this->_options = $option;
        }
        return $this->_options;
    }
}

