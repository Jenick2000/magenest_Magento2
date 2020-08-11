<?php

namespace Learning\FirstUnit\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Catalog\Model\CategoryFactory;

class Subscription extends \Magento\Framework\App\Action\Action
{


    /**
     * @var \Learning\FirstUnit\Model\SubscriptionFactory
     */
    private $subscriptionFactory;
    /**
     * @var CategoryFactory
     */
    protected $_categoryFactory;


    public function __construct(Context $context,
                                CategoryFactory $categoryFactory,
                                \Learning\FirstUnit\Model\SubscriptionFactory $subscriptionFactory)
    {
        $this->subscriptionFactory = $subscriptionFactory;
        $this->_categoryFactory = $categoryFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        // TODO: Implement execute() method.
        /** @var \Learning\FirstUnit\Model\Subscription $subscription */
        $subscription = $this->subscriptionFactory->create();
        $subscription->setFirstname('NgocA');
        $subscription->setLastname('Nguyen');
        $subscription->setEmail('ngoca.Lee@example.com');
        $subscription->setMessage('Say hello with Jenick');
        // $subscription->save();
        $test = $this->_objectManager->get('\Magenest\Movie\Model\ResourceModel\Movie\Collection');//get('\Magenest\Movie\Model\ResourceModel\Movie\Collection');
        var_dump($test->getData());

        $this->getResponse()->setBody('sussecc');
    }
}