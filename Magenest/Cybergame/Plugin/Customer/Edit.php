<?php

namespace Magenest\Cybergame\Plugin\Customer;

use Magento\Framework\App\Action\AbstractAction;
use Magento\Framework\App\RequestInterface;

class Edit
{

    /**
     * @var \Magento\Customer\Api\CustomerRepositoryInterface
     */
    protected $customerRepository;
    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $customerSession;

    public function __construct(\Magento\Customer\Api\CustomerRepositoryInterface $customerRepository, \Magento\Customer\Model\Session $customerSession)
    {
        $this->customerRepository = $customerRepository;
        $this->customerSession = $customerSession;
    }

    public function beforeDispatch(AbstractAction $subject, RequestInterface $request)
    {
        $data = $subject;

        $customerCurrent = $this->customerSession->getCustomer()->getData();
        $is_manager = $data->getRequest()->getPost('is_manager');
        if (!empty($is_manager)) {
            $customer = $this->customerRepository->getById($customerCurrent['entity_id']);
            $customer->setCustomAttribute('is_manager', 1);
            $this->customerRepository->save($customer);
        } else {
            $customer = $this->customerRepository->getById($customerCurrent['entity_id']);
            $customer->setCustomAttribute('is_manager', 0);
            $this->customerRepository->save($customer);
        }

    }
}