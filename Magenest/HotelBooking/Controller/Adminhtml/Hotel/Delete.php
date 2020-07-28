<?php

namespace Magenest\HotelBooking\Controller\Adminhtml\Hotel;

use Magento\Backend\App\Action;
use Magenest\HotelBooking\Model\HotelFactory;

class Delete extends Action
{
    /**
     * @var \Magenest\HotelBooking\Model\HotelFactory
     */
    protected $hotelFactory;

    public function __construct(Action\Context $context, HotelFactory $hotelFactory)
    {
        $this->hotelFactory = $hotelFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $hotel = $this->hotelFactory->create();
        $hote_id = $this->getRequest()->getParam('id');
        if ($hotel->load($hote_id)->getId()) {
            $hotel_name = $hotel->getHotelName();
            $hotel->delete();
            $this->messageManager->addSuccessMessage('You deleted ' . $hotel_name);
            $this->_redirect('*/*/index');
        } else {
            $this->messageManager->addErrorMessage("You can't Delete this hotel");
            $this->_redirect('*/*/index');
        }
    }
}