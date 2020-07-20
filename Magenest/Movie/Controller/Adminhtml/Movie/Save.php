<?php

namespace Magenest\Movie\Controller\Adminhtml\Movie;

use Magento\Backend\App\Action;
use Magenest\Movie\Model\MovieFactory as movieFactory;
use Magenest\Movie\Model\MovieActorsFactory as movieActorsFactory;
use Magenest\Movie\Model\ResourceModel\MovieActors\CollectionFactory;

class Save extends \Magento\Framework\App\Action\Action {

    /**
     * @var movieFactory
     */
    protected $_movieFactory;
    /**
     * @var movieActorsFactory
     */
    protected $_movieActorFactory;
    /**
     * @var CollectionFactory
     */
    protected $_movieActorCollection;


    public function __construct(Action\Context $context,CollectionFactory $movieActorCollectionFactory, movieFactory $movieFactory, movieActorsFactory $movieActorFactory)
        {
            $this->_movieFactory = $movieFactory;
            $this->_movieActorFactory = $movieActorFactory;
            $this->_movieActorCollection = $movieActorCollectionFactory;
            parent::__construct($context);
        }

    public function execute()
    {

       $data = $this->getRequest()->getPost();
       $movie = $this->_movieFactory->create();

       if($movie->load($data['movie_id'])->getId()){

           $movie->setName($data['name']);
           $movie->setDescription($data['description']);
           $movie->setDirectorId((int)$data['director_id']);
           $movie->save();

           $movie_id = $data['movie_id'];
           $movieActor = $this->_movieActorFactory->create();
           $movieActorCollection = $this->_movieActorCollection->create();
           $movieActorCollection->addFieldToFilter('movie_id', $movie_id);
           $allMovieActor = $movieActorCollection->getData();

           $index = 0;

           foreach ($data['actors'] as $actor) {

                $total = count($data['actors']);
               for($index; $index <  $total;){
                   if($index < count($allMovieActor)){
                       $movie_actor_id = $allMovieActor[$index]['id'];
                       if($movieActor->load($movie_actor_id)){
                           $movieActor->setActorId((int)$actor);
                           $movieActor->save();
                           $index++;
                           break;
                       }
                   }else{
                       $movieActor = $this->_movieActorFactory->create();
                       $movieActor->setMovieId($movie_id);
                       $movieActor->setActorId((int)$actor);
                       $movieActor->save();
                       break;
                   }

               }
           }
           $this->_redirect('magenest/movie/index');
           $this->messageManager->addSuccessMessage('You saved new movie');
       }else{
           $this->addNewMovie();
       }

    }

    public function addNewMovie() {

        $data = $this->getRequest()->getPost();
        $movie = $this->_movieFactory->create();
        $movie->setName($data['name']);
        $movie->setDescription($data['description']);
        $movie->setDirectorId((int)$data['director']);
        $movie->save();

        $movie_id = $movie->getId();
        foreach ($data['actors'] as $actor){
            $movieActor = $this->_movieActorFactory->create();

            $movieActor->setMovieId($movie_id);
            $movieActor->setActorId((int)$actor);
            $movieActor->save();
        }
        //after save movie
        $this->_eventManager->dispatch('movie_save',['movie'=>$movie]);
        $this->_redirect('magenest/movie/index');
        $this->messageManager->addSuccessMessage('You saved new movie');
    }
}