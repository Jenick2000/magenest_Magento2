<?php

namespace Magenest\HotelBooking\Model\Attribute\Source;

use Magenest\HotelBooking\Model\ResourceModel\Hotel\CollectionFactory;

class Hotel extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    public function __construct(CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
    }

    public function getAllOptions()
    {
        $hotel = $this->collectionFactory->create();
        $allHotel = $hotel->getData();
        if (!$this->_options) {
            $option = [['label' => __('-- Choose Hotel --'), 'value' => '']];
            foreach ($allHotel as $manu) {
                $item = ['label' => $manu['hotel_name'], 'value' => $manu['hotel_id']];
                array_push($option, $item);
            }
            $this->_options = $option;
        }
        return $this->_options;
    }
}