<?php

namespace Magenest\Movie\Model\Config\Source;


class SelectDirector implements \Magento\Framework\Data\OptionSourceInterface {

    /**
     * @var \Magenest\Movie\Model\ResourceModel\Director\CollectionFactory
     */
    protected $collectionFactory;

    public function __construct(\Magenest\Movie\Model\ResourceModel\Director\CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
    }

    public function toOptionArray()
   {
       $collection = $this->collectionFactory->create();
       $directors = $collection->getData();
       $items = [];
       foreach ($directors as $director) {
           $item = ['value'=>$director['director_id'], 'label' => $director['name']];
           array_push($items, $item);
       }
       return $items;
   }
}
