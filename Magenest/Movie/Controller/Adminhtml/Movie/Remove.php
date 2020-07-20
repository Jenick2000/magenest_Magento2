<?php

namespace  Magenest\Movie\Controller\Adminhtml\Movie;

use Magenest\Movie\Model\MovieFactory;
use Magento\Backend\App\Action;
use Magenest\Movie\Model\MovieActorsFactory;

class Remove extends \Magento\Backend\App\Action{

    /**
     * @var MovieFactory
     */
    protected $_movieFactory;
    /**
     * @var MovieActorsFactory
     */
    protected $_movieActorFactory;


    public function __construct(Action\Context $context,
                                MovieFactory $movieFactory,
                                MovieActorsFactory $movieActorFactory
                               )
    {
        $this->_movieFactory = $movieFactory;
        $this->_movieActorFactory = $movieActorFactory;
        parent::__construct($context);
    }

    public function execute()
    {
      $movie_id = $this->getRequest()->getParam('id');

        $movieFactory = $this->_movieFactory->create();

        $movieActorCollection = $this->_objectManager->create('Magenest\Movie\Model\ResourceModel\MovieActors\Collection');
        $movieActorCollection->addFieldToFilter('movie_id', $movie_id);
        $allma = $movieActorCollection->getData();

        if($movieFactory->load($movie_id)) {
            try {
                $movieFactory->delete();
                foreach ($allma as $ma){
                   $movie_Actor = $this->_movieActorFactory->create();
                  if( $movie_Actor->load($ma['id'])){
                      $movie_Actor->delete();
                  }
                }
                $this->_redirect('magenest/movie/index');
                $this->messageManager->addSuccess('you removed movie');
            }catch (Exception $e){
                $this->messageManager->addError("Can't remove movie: ". $e);
            }

        }

    }
}