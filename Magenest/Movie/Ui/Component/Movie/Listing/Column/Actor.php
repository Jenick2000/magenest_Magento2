<?php

namespace Magenest\Movie\Ui\Component\Movie\Listing\Column;

use \Magento\Framework\View\Element\UiComponent\ContextInterface;
use \Magento\Framework\View\Element\UiComponentFactory;
use \Magento\Ui\Component\Listing\Columns\Column;
use Magenest\Movie\Model\ResourceModel\Actor\CollectionFactory as ActorCollectionFactory;
use Magenest\Movie\Model\ResourceModel\MovieActors\CollectionFactory as MovieActorCollectionFactory;

class Actor extends Column {


    /**
     * @var ActorCollectionFactory
     */
    protected $ActorCollection;
    /**
     * @var MovieActorCollectionFactory
     */
    protected $movieActorCollection;

    public function __construct(ContextInterface $context,
                                UiComponentFactory $uiComponentFactory,
                                ActorCollectionFactory $actorCollectionFactory,
                                MovieActorCollectionFactory $movieActorCollectionFactory,
                                array $components = [],
                                array $data = [])
    {
        $this->ActorCollection = $actorCollectionFactory;
        $this->movieActorCollection = $movieActorCollectionFactory;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {

                $movie_id = $item['movie_id'];
                $actors = $this->actorOfMovie($movie_id);
                $data = '';
                foreach ($actors as $key=>$actor) {
                    if($key == count($actors) - 1){
                        $data  .= $actor['name'];
                    }else{
                        $data  .= $actor['name'].', ';
                    }

                }
                if(count($actors) == 0) $data = "No actors";

                $item['actor'] = $data;
            }
        }
        return parent::prepareDataSource($dataSource);
    }

    public function actorOfMovie($movie_id) {
        $actors_id = $this->getIdActors($movie_id);
        if(count($actors_id) == 0) return [];

        $actors = $this->ActorCollection->create();
        $actors->addFieldToFilter('actor_id', array('in', $actors_id));
        return $actors->getData();
    }


    protected function getIdActors($movie_id) {

        $movieActor = $this->movieActorCollection->create();
        $movieActor->addFieldToFilter('movie_id', $movie_id);
        $data = $movieActor->getData();
        return $this->toArrActorId($data);
    }

    public function toArrActorId($data){
        $actorsId = [];
        foreach ($data as $item) {
            array_push($actorsId, $item['actor_id']);
        }
        return $actorsId;
    }


}