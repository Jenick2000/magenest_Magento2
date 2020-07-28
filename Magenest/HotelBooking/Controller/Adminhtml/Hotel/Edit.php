<?php

namespace Magenest\HotelBooking\Controller\Adminhtml\Hotel;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;

class Edit extends Action
{

    /**
     * @var PageFactory
     */
    protected $pageFacory;
    /**
     * @var \Magenest\HotelBooking\Model\HotelFactory
     */
    protected $hotelFactory;

    public function __construct(Action\Context $context, PageFactory $pageFactory, \Magenest\HotelBooking\Model\HotelFactory $hotelFactory)
    {
        $this->pageFacory = $pageFactory;
        $this->hotelFactory = $hotelFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $hotel_id = $this->getRequest()->getParam('id');
        $hotel = $this->hotelFactory->create()->load($hotel_id);
        $resultPage = $this->pageFacory->create();

        if ($hotel->getId()) {
            $resultPage->getConfig()->getTitle()->prepend($hotel->getHotelName());
            return $resultPage;
        } else {
            exit('Not Found');
        }

    }
}

