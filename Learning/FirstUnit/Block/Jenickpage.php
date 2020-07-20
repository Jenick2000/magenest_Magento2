<?php
namespace Learning\FirstUnit\Block;

use \Magento\Framework\View\Element\Template;

class Jenickpage extends Template
{
    protected $_subscriptionFactory;

    public function __construct(Template\Context $context,\Learning\FirstUnit\Model\ResourceModel\Subscription\CollectionFactory $SubscriptionCollectionFactory, array $data = [])
    {
        $this->_subscriptionFactory = $SubscriptionCollectionFactory;
        parent::__construct($context, $data);
    }

    public function sayHi() {
        return 'Jenick say hello everyone!';
    }

    public function getSubscriptions() {

        $collection = $this->_subscriptionFactory->create();
//        $collection->addFieldToFilter('firstname','Jenick');
        $collection->setPageSize(5);
//        var_dump($collection->getData());
//        exit('test');
        return $collection;
    }
}