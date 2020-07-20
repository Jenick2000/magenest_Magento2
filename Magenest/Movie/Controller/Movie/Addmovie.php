<?php
namespace Magenest\Movie\Controller\Movie;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magenest\Movie\Model\ActorFactory;
use Magenest\Movie\Model\DirectorFactory;
use Magenest\Movie\Model\MovieFactory;

class Addmovie extends Action {

    /**
     * @var ActorFactory
     */
    protected $_actorFactory;
    /**
     * @var DirectorFactory
     */
    protected $_directorFactory;
    /**
     * @var MovieFactory
     */
    protected $_movieFactory;

    public function __construct(Context $context, ActorFactory $actorFactory, DirectorFactory $directorFactory, MovieFactory $movieFactory)
    {

        $this->_actorFactory = $actorFactory;
        $this->_directorFactory = $directorFactory;
        $this->_movieFactory = $movieFactory;
        parent::__construct($context);
    }
    public function execute()
    {
//        $actory = $this->_actorFactory->create();
//        $actory->setName('Marry');
//        $actory->save();
//
//        $director = $this->_directorFactory->create();
//        $director->setName('Truong Vu');
//        $director->save();

        $movie = $this->_movieFactory->create();
        $movie->setName('Mr Bean');;
        $movie->setDescription('The film is about the Mr Bean');
        $movie->setDirectorId(1);
        $movie->save();
         $this->getResponse()->setBody('add success');

    }
}