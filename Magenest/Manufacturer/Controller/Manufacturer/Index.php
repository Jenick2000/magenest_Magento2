<?php

namespace Magenest\Manufacturer\Controller\Manufacturer;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magenest\Manufacturer\Model\ResourceModel\Manufacturer\CollectionFactory;

class Index extends Action
{
    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    public function __construct(Context $context, CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $manu = $this->collectionFactory->create();
        var_dump($manu->getData());
        exit('ok lkl');
    }
}