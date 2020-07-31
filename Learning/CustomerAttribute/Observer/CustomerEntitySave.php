<?php

namespace Learning\CustomerAttribute\Observer;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class CustomerEntitySave implements ObserverInterface {

    /** @var \Psr\Log\LoggerInterface $logger */
    protected $logger;
    protected $request;
    /**
     * @var \Magento\Customer\Api\CustomerRepositoryInterface
     */
    protected $_customerRepositoryInterface;


    public function __construct(\Psr\Log\LoggerInterface $logger,\Magento\Framework\App\RequestInterface $request, \Magento\Customer\Api\CustomerRepositoryInterface $customerRepositoryInterface)
    {
        $this->logger = $logger;
        $this->request = $request;
        $this->_customerRepositoryInterface = $customerRepositoryInterface;

    }
    public function execute(Observer $observer)
    {

        $data = $this->request->getPost('nickname');

        $customerData = $observer->getData('customer');
        $customerData->setNickName($data);
        $customerData->save();

        $this->logger->debug('save customer entity');
    }
}


