<?php
namespace Magenest\Movie\Model\Config\Source;

class SelectActor implements \Magento\Framework\Data\OptionSourceInterface {

    /**
     * @var \Magenest\Movie\Model\ResourceModel\Director\CollectionFactory
     */
    protected $ActorCollectionFactory;

    public function __construct(\Magenest\Movie\Model\ResourceModel\Actor\CollectionFactory $collectionFactory)
    {
        $this->ActorCollectionFactory = $collectionFactory;
    }


    public function toOptionArray()
    {

        $collection = $this->ActorCollectionFactory->create();
        $actors = $collection->getData();
        $items = [];
        foreach ($actors as $actor) {
            $item = ['value'=> $actor['actor_id'], 'label' => $actor['name']];
            array_push($items, $item);
        }
        return $items;

    }

}