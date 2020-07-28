<?php

namespace Magenest\Manufacturer\Block\Product;

use Magento\Framework\View\Element\Template;
use Magenest\Manufacturer\Model\ManufacturerFactory;
use Magento\Catalog\Model\ProductFactory as productFactory;

class View extends Template
{
    /**
     * @var ManufacturerFactory
     */
    protected $manufacturerFactory;
    /**
     * @var ProductRepositoryInterface
     */
    protected $productRepository;
    /**
     * @var ProductFactory
     */
    protected $productFactory;

    public function __construct(Template\Context $context,
                                ManufacturerFactory $manufacturerFactory,
                                ProductFactory $productFactory,
                                array $data = [])
    {
        $this->manufacturerFactory = $manufacturerFactory;
        $this->productFactory = $productFactory;
        parent::__construct($context, $data);
    }

    public function sayHi()
    {

        return 'Jenick say hello everyone!';
    }


    public function getManufacturer()
    {
        $product_id = $this->getRequest()->getParam('id');

        $product = $this->productFactory->create();
        $product->load($product_id);
        $data = $product->getData();
        if (empty($data['manufacturer_id'])) return [];
        $manufacturer = $this->manufacturerFactory->create()->load($data['manufacturer_id']);

        return $manufacturer->getData();;
    }

    public function getNameManufacturer()
    {
        if (count($this->getManufacturer()) != 0) {
            return $this->getManufacturer()['name'];
        }
        return '';
    }

    public function showInfoManufacturer()
    {
        if (count($this->getManufacturer()) != 0) {
            $data = $this->getManufacturer();
            $result = ' Name: ' . $data['name'] . '\n Street address: ' . $data['address_street']
                . '\n Address City: ' . $data['address_city']
                . '\n Phone: ' . $data['contact_phone'];

            return $result;
        }
        return '';
    }
}