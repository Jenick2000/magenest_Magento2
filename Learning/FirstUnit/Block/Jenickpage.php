<?php

namespace Learning\FirstUnit\Block;

use \Magento\Framework\View\Element\Template;

class Jenickpage extends Template
{
    protected $_subscriptionFactory;
    public $name;

    public function __construct(Template\Context $context, \Learning\FirstUnit\Model\ResourceModel\Subscription\CollectionFactory $SubscriptionCollectionFactory, array $data = [])
    {
        $this->_subscriptionFactory = $SubscriptionCollectionFactory;
        parent::__construct($context, $data);
    }

    public function sayHi()
    {
        return 'Jenick say hello everyone!';
    }

    public function getSubscriptions()
    {

        $collection = $this->_subscriptionFactory->create();
//        $collection->addFieldToFilter('firstname','Jenick');
        $collection->setPageSize(5);
//        var_dump($collection->getData());
//        exit('test');
        return $collection;
    }

    public function setName($name, $age)
    {
        $this->name = $name;
        if ($this->name == 'Jenick') {
            $this->name = 'Jenick handsome age: ' . $age;
        }
    }

    public function getName()
    {
        return $this->name;
    }

    public function test($pram1, $pram2)
    {
        if ($pram1 == 'You') {
            return 'Who are You ???';
        }
        return $pram1 . ' LOVE ' . $pram2;
    }

}