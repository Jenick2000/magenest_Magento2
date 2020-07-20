<?php

namespace Learning\FirstUnit\Controller\Index;

use Magento\Framework\App\Action\Context;

class Subscription extends \Magento\Framework\App\Action\Action {


    /**
     * @var \Learning\FirstUnit\Model\SubscriptionFactory
     */
    private $subscriptionFactory;

    public function __construct(Context $context, \Learning\FirstUnit\Model\SubscriptionFactory $subscriptionFactory)
{
    $this->subscriptionFactory = $subscriptionFactory;
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
        $subscription->save();
        $this->getResponse()->setBody('sussecc');
    }
}