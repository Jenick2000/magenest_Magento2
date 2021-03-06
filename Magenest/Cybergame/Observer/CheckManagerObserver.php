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
        $is_magager = $data->getRequest()->getPost('is_manager');
        if (!empty($is_magager)) {
            $customerData = $observer->getCustomer();
            $id = $customerData->getId();
            $customer = $this->customerRepository->getById($id);
            $customer->setCustomAttribute('is_manager', 1);
            $this->customerRepository->save($customer);
        }
    }
}