<?php

namespace Magenest\HotelBooking\Controller\Booking;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magenest\HotelBooking\Model\ResourceModel\CustomOrder\CollectionCustomFactory;

class Index extends Action
{
    /**
     * @var \Magenest\HotelBooking\Model\ResourceModel\Hotel\CollectionFactory
     */
    protected $hotelCollectionFactory;
    /**
     * @var CollectionCustomFactory
     */
    protected $collectionCustomFactory;

    public function __construct(Context $context, CollectionCustomFactory $collectionCustomFactory, \Magenest\HotelBooking\Model\ResourceModel\Hotel\CollectionFactory $collectionFactory)
    {
        $this->hotelCollectionFactory = $collectionFactory;
        $this->collectionCustomFactory = $collectionCustomFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $hotels = $this->hotelCollectionFactory->create();
        $order = $this->collectionCustomFactory->create();
        $a = $order->getData();
        var_dump($order->getData());
    }
}