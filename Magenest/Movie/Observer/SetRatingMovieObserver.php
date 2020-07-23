<?php

namespace Magenest\Movie\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class SetRatingMovieObserver implements ObserverInterface
{

    /**
     * @var \Magenest\Movie\Model\MovieFactory
     */
    protected $movieFactory;

    public function __construct(\Magenest\Movie\Model\MovieFactory $movieFactory)
    {
        $this->movieFactory = $movieFactory;
    }

    public function execute(Observer $observer)
    {
        $movieData = $observer->getMovie();
        if($movieData['rating'] == '') {
            $movie = $this->movieFactory->create();
            $movie->load($movieData['movie_id']);
            $movie->setRating(0);
            $movie->save();
        }
    }
}