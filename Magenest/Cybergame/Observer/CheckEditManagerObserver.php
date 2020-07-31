<?php

namespace Magenest\Cybergame\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class CheckEditManagerObserver implements ObserverInterface
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

        $is_magager = $observer->getData('dataPost')->getPost('is_manager');
        $email = $observer->getData('email');
        if (!empty($is_magager)) {
            $customer = $this->customerRepository->get($email);
            $customer->setCustomAttribute('is_manager', 1);
            $this->customerRepository->save($customer);
        }
    }
}