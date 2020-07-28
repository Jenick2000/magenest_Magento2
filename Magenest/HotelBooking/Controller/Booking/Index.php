<?php

namespace Magenest\HotelBooking\Controller\Booking;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

class Index extends Action
{
    /**
     * @var \Magenest\HotelBooking\Model\ResourceModel\Hotel\CollectionFactory
     */
    protected $hotelCollectionFactory;

    public function __construct(Context $context, \Magenest\HotelBooking\Model\ResourceModel\Hotel\CollectionFactory $collectionFactory)
    {
        $this->hotelCollectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $hotels = $this->hotelCollectionFactory->create();
        var_dump($hotels->getData());
    }
}