<?php

namespace Magenest\Cybergame\Controller\GamerAccount;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magenest\Cybergame\Model\ResourceModel\GamerAccountList\CollectionFactory;

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
        $collection = $this->collectionFactory->create();
        var_dump($collection->getData());
    }
}