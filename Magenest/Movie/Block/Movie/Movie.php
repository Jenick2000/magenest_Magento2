<?php

namespace Magenest\Movie\Block\Movie;
use Magento\Framework\View\Element\Template;
use Magenest\Movie\Model\ResourceModel\Movie\CollectionFactory;



class Movie extends Template {

    /**
     * @var CollectionFactory
     */
    protected $_collectionMovieFactory;
    /**
     * @var Magenest\Movie\Model\ResourceModel\Director\CollectionFactory
     */
    protected $_directorFatory;
    /**
     * @var \Magenest\Movie\Model\ResourceModel\Actor\CollectionFactory
     */
    protected $_actorFactory;
    /**
     * @var \Magenest\Movie\Model\ResourceModel\Movie_actor\CollectionFactory
     */
    protected $_movieActorFactory;

    public function __construct(Template\Context $context, array $data = [], CollectionFactory $collectionMovieFactory
                                ,\Magenest\Movie\Model\ResourceModel\Director\CollectionFactory $directorFactory
                                  ,\Magenest\Movie\Model\ResourceModel\Actor\CollectionFactory $actorFactory
                                ,\Magenest\Movie\Model\ResourceModel\MovieActors\CollectionFactory $movieActorFactory
                                )
    {
        $this->_collectionMovieFactory = $collectionMovieFactory;
        $this->_directorFatory = $directorFactory;
        $this->_actorFactory = $actorFactory;
        $this->_movieActorFactory = $movieActorFactory;
        parent::__construct($context, $data);
    }

    public function AllMovie() {
        $movie = $this->_collectionMovieFactory->create();
        $movie->setPageSize(5);
        return $movie;
    }

    public function directorOfMovie($movie_id) {

        $director = $this->_directorFatory->create();
        $director->addFieldToFilter('director_id', $movie_id);
        $director->getData();
        return $director;
//dsds
    }

    public function actorOfMovie($movie_id) {
        $actors_id = $this->getIdActor($movie_id);
        if(count($actors_id) == 0) return [];

        $actors = $this->_actorFactory->create();
        $actors->addFieldToFilter('actor_id', array('in', $actors_id));
        return $actors;
    }
    public function getIdActor($movie_id) {
        $actorsMovie = $this->_movieActorFactory->create();
        $actorsMovie->addFieldToFilter('movie_id', $movie_id);
        $actorsMovie->getData();
        return $this->toArrActorId($actorsMovie);
    }

    public function toArrActorId($data){
        $actorsId = [];
        foreach ($data as $item) {
            array_push($actorsId, $item->getActorId());
        }
        return $actorsId;
    }
}
