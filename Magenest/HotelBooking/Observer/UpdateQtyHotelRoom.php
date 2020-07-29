<?php

namespace Magenest\HotelBooking\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Catalog\Model\ProductFactory;
use Magenest\HotelBooking\Model\HotelFactory;

class UpdateQtyHotelRoom implements ObserverInterface
{
    /**
     * @var ProductFactory
     */
    protected $productFactory;
    /**
     * @var HotelFactory
     */
    protected $hotelFactory;

    public function __construct(ProductFactory $productFactory, HotelFactory $hotelFactory)
    {
        $this->productFactory = $productFactory;
        $this->hotelFactory = $hotelFactory;
    }

    public function execute(Observer $observer)
    {

        $order = $observer->getData('order');
        $items = $order->getData()['items'];
        foreach ($items as $item) {
            $product_id = $item->getData()['product_id'];
            $qtyOrdered = $item->getData()['qty_ordered'];
            $product = $this->productFactory->create();
            $data = $product->load($product_id)->getData();
            if (!empty($data['hotel_id']) && $data['has_options'] == 0) {
                $hotel_id = $data['hotel_id'];
                $optionValue = $data['room_type'];
                $hotel = $this->hotelFactory->create();
                $hotelData = $hotel->load($hotel_id);

                if ($optionValue == 'single') {
                    $roomsingle = $hotelData->getAvailableSingle() - $qtyOrdered;
                    $totalRoom = $hotelData->getTotalAvailableRoom() - $qtyOrdered;
                    $hotelData->setAvailableSingle($roomsingle);
                    $hotelData->setTotalAvailableRoom($totalRoom);
                    $hotelData->save();
                } else if ($optionValue == 'double') {
                    $roomDouble = $hotelData->getAvailableDouble() - $qtyOrdered;
                    $totalRoom = $hotelData->getTotalAvailableRoom() - $qtyOrdered;
                    $hotelData->setAvailableDouble($roomDouble);
                    $hotelData->setTotalAvailableRoom($totalRoom);
                    $hotelData->save();
                } else if ($optionValue == 'triple') {
                    $roomTriple = $hotelData->getAvailableTriple() - $qtyOrdered;
                    $totalRoom = $hotelData->getTotalAvailableRoom() - $qtyOrdered;
                    $hotelData->setAvailableTriple($roomTriple);
                    $hotelData->setTotalAvailableRoom($totalRoom);
                    $hotelData->save();
                }
            }
        }
    }
}