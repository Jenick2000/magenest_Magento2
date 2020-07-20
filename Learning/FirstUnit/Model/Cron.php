<?php

namespace Learning\FirstUnit\Model;

use Magento\TestFramework\Event\Magento;

class Cron {

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;
    protected $objectManager;
    public function __construct(\Psr\Log\LoggerInterface $logger, \Magento\Framework\ObjectManagerInterface $objectManager)
    {
        $this->logger = $logger;
        $this->objectManager = $objectManager;
    }

    public function CheckSubscriptions() {

        $subscription = $this->objectManager->create('Learning\FirstUnit\Model\Subscription');
        $subscription->setFirstname('Cron');
        $subscription->setLastname('Job 2');
        $subscription->setEmail('cron2.job@example.com');
        $subscription->setMessage('Created from cron');
        $subscription->save();
        $this->logger->debug('Test subscription added');
    }
}