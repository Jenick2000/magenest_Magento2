<?php

namespace Magenest\HotelBooking\Controller\Adminhtml\Hotel;

use Magenest\HotelBooking\Model\HotelFactory;
use Magento\Backend\App\Action;

class Save extends Action
{

    /**
     * @var HotelFactory
     */
    protected $hotelFactory;

    public function __construct(Action\Context $context, HotelFactory $hotelFactory)
    {
        $this->hotelFactory = $hotelFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->getRequest()->getPost();
        $hotel = $this->hotelFactory->create();
        if ($hotel->load($data['hotel_id'])->getId()) {
            $this->saveHotel($hotel, $data);
        } else {
            $this->saveHotel($hotel, $data);
        }
    }

    protected function saveHotel($hotel, $data)
    {

        $hotel->setHotelName($data['hotel_name']);
        $hotel->setLocationStreet($data['location_street']);
        $hotel->setLocationCity($data['location_city']);
        $hotel->setLocationState($data['location_state']);
        $hotel->setLocationCountry($data['location_country']);
        $hotel->setContactPhone($data['contact_phone']);
        $hotel->setTotalAvailableRoom($data['total_available_room']);
        $hotel->setAvailableSingle($data['available_single']);
        $hotel->setAvailableDouble($data['available_double']);
        $hotel->setAvailableTriple($data['available_triple']);
        $hotel->save();
        $this->messageManager->addSuccessMessage('You saved hotel');
        $this->_redirect('*/*/index');
    }
}