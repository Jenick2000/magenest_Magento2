<?php

namespace Magenest\Cybergame\Block\Customer;

use Magento\Framework\View\Element\Template;
use Magento\Customer\Helper\Session\CurrentCustomer;

class CustomForm extends Template
{
    /**
     * @var \Magento\Customer\Api\CustomerRepositoryInterface
     */
    protected $customerRepository;
    /**
     * @var CurrentCustomer
     */
    protected $currentCustomer;

    public function __construct(Template\Context $context, CurrentCustomer $currentCustomer, \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository, array $data = [])
    {
        $this->customerRepository = $customerRepository;
        $this->currentCustomer = $currentCustomer;
        parent::__construct($context, $data);
    }

    public function IsManager()
    {

        $id = $this->currentCustomer->getCustomerId();
        $customer = $this->customerRepository->getById($id);
        $is_manager = $customer->getCustomAttribute('is_manager');
        if (!empty($is_manager) && $is_manager->getValue() == 1) {
            return true;
        }
        return false;
    }
}