<?php

namespace Magenest\HotelBooking\Block\Hotel;

use Magento\Framework\View\Element\Template;
use Magenest\HotelBooking\Model\HotelFactory;
use Magento\Catalog\Model\ProductFactory;

class Detail extends Template
{

    /**
     * @var HotelFactory
     */
    protected $hotelFactory;
    /**
     * @var ProductFactory
     */
    protected $productFactory;

    public function __construct(Template\Context $context, HotelFactory $hotelFactory, ProductFactory $productFactory, array $data = [])
    {
        $this->hotelFactory = $hotelFactory;
        $this->productFactory = $productFactory;
        parent::__construct($context, $data);
    }

    public function checkIsHotel()
    {
        $product_id = $this->getRequest()->getParam('id');
        $product = $this->productFactory->create()->load($product_id);
        if (!empty($product->getData()['hotel_id'])) {
            return true;
        }
        return false;
    }

    public function getHotel()
    {
        $product_id = $this->getRequest()->getParam('id');
        $product = $this->productFactory->create()->load($product_id);
        $productData = $product->getData();
        if (empty($productData['hotel_id'])) {
            return [];
        }
        $hotel_id = $productData['hotel_id'];
        $hotel = $this->hotelFactory->create();
        $hotelData = $hotel->load($hotel_id);
        return $hotelData->getData();
    }
}