<?php
namespace Magenest\Movie\Model\MovieProvider;

use Magenest\Movie\Model\ResourceModel\Movie\CollectionFactory;
use Magenest\Movie\Model\ResourceModel\MovieActors\CollectionFactory as ActorCollectionFactory;
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider {


    protected $collection;
    protected $_loadedData;
    /**
     * @var ActorCollectionFactory
     */
    protected $_actorCollectionFactory;

    public function __construct($name, $primaryFieldName, $requestFieldName,CollectionFactory $SubscriptionCollectionFactory, ActorCollectionFactory $actorCollectionFactory , array $meta = [], array $data = [])
    {
        $this->collection = $SubscriptionCollectionFactory->create();
        $this->_actorCollectionFactory = $actorCollectionFactory;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if(isset($this->_loadedData)) return $this->_loadedData;
        $items = $this->collection->getItems();
        $key = '';
        foreach ($items as $item) {
            $this->_loadedData[$item->getMovieId()] = $item->getData();
            $key = $item->getMovieId();
        }

        $this->_loadedData[$key]['actors'] =  $this->getIdActors($key);
        return $this->_loadedData;


    }

    public function getIdActors($movie_id) {
       $actors =  $this->_actorCollectionFactory->create();
       $actors->addFieldToFilter('movie_id', $movie_id);
       $actors->getData();
       $items = '';
       foreach ($actors as $index=>$actor) {
           if($index == count($actors)  ){
               $items.= $actor['actor_id'];
           }else{
               $items.= $actor['actor_id'].',';
           }

       }
       return $items;
    }
}

