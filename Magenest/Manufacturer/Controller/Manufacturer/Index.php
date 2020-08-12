<?php

namespace Magenest\Manufacturer\Controller\Manufacturer;

use Magento\Catalog\Model\ProductRepository;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

class Index extends Action
{


    /**
     * @var \Magenest\Manufacturer\Model\ManufacturerRepository
     */
    protected $_manufactorerRepository;
    /**
     * @var Magento\Catalog\Model\ProductRepository
     */
    protected $productRepository;

    public function __construct(Context $context,
                                \Magento\Catalog\Model\ProductRepository $productRepository,
                                \Magenest\Manufacturer\Model\ManufacturerRepository $manufacturerRepository)
    {
        $this->_manufactorerRepository = $manufacturerRepository;
        $this->productRepository = $productRepository;
        parent::__construct($context);
    }

    public function execute()
    {
        $manu = $this->_manufactorerRepository->getById(1);
        $product = $this->productRepository->getById('10');
        var_dump($manu);
        exit('ok lkl');
    }
}