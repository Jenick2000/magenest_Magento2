<?php
namespace Magenest\Movie\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class ChangeFirstNameCustomerObserver implements ObserverInterface {


    /**
     * @var \Magento\Customer\Api\CustomerRepositoryInterface
     */
    protected $customerRepository;

    public function __construct( \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function execute(Observer $observer)
    {

            $customerData = $observer->getCustomer();
            $id = $customerData->getId();
            $customer = $this->customerRepository->getById($id);
            $customer->setFirstName('Magenest');
            $this->customerRepository->save($customer);

    }
}
