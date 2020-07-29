<?php

namespace Magenest\Cybergame\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class CheckManagerObserver implements ObserverInterface
{

    /**
     * @var \Magento\Customer\Api\CustomerRepositoryInterface
     */
    protected $customerRepository;

    public function __construct(\Magento\Customer\Api\CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function execute(Observer $observer)
    {
        $data = $observer->getAccountController();
        $customerData = $observer->getCustomer();
        $id = $customerData->getId();
        $customer = $this->customerRepository->getById($id);
        $customer->setIsManager(1);
        $this->customerRepository->save($customer);
    }
}