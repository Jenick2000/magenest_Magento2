<?php

namespace Magenest\Movie\Controller\Movie;

use Magenest\Movie\Model\ResourceModel\Movie\CollectionFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

class Showcollection extends Action
{

    /**
     * @var CollectionFactory
     */
    protected $_collectionFactory;

    public function __construct(Context $context, CollectionFactory $collectionFactory)
    {
        $this->_collectionFactory = $collectionFactory;

        parent::__construct($context);
    }

    public function execute()
    {
        $collection = $this->_collectionFactory->create();
        var_dump($collection->getdata());

    }
}