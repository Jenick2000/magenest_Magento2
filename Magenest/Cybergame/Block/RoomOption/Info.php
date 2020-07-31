<?php

namespace Magenest\Cybergame\Block\RoomOption;

use Magento\Framework\View\Element\Template;
use Magento\Catalog\Model\ProductFactory;
use Magenest\Cybergame\Model\ResourceModel\RoomExtraOption\CollectionFactory as RoomExtraOptionCollectionFactory;

class Info extends Template
{

    /**
     * @var ProductFactory
     */
    protected $productFactory;
    /**
     * @var RoomExtraOptionCollectionFactory
     */
    protected $roomExtraOptionCollectionFactory;
    protected $product_id;

    public function __construct(Template\Context $context, ProductFactory $productFactory, RoomExtraOptionCollectionFactory $roomExtraOptionCollectionFactory, array $data = [])
    {
        $this->productFactory = $productFactory;
        $this->roomExtraOptionCollectionFactory = $roomExtraOptionCollectionFactory;

        parent::__construct($context, $data);
    }

    public function getProduct()
    {
        $this->product_id = $this->getRequest()->getParam('id');
        $product = $this->productFactory->create()->load($this->product_id);
        return $product->getData();
    }

    public function getRoomExtraOption()
    {
        $this->product_id = $this->getRequest()->getParam('id');
        $roomOption = $this->roomExtraOptionCollectionFactory->create()
            ->addFieldToFilter('product_id', $this->product_id);
        $data = $roomOption->getData();
        return $data[0];

    }

}