<?php

namespace Learning\FirstUnit\Controller\Adminhtml\Subscription;


use Magento\Framework\App\Action\Context;

class Save extends \Magento\Framework\App\Action\Action
{


    public function execute( )
    {
        $data = $this->getRequest()->getPost();
        $subscription_id = $data['subscription_id'];
        $subscription = $this->_objectManager->create('Learning\FirstUnit\Model\Subscription');

        if($subscription->load($subscription_id)->getId()) {

            $subscription->setFirstname($data['firstname']);
            $subscription->setLastname($data['lastname']);
            $subscription->setEmail($data['email']);
            $subscription->setStatus($data['status']);
            $subscription->save();
            $this->messageManager->addSuccessMessage(__('You saved subscriber success'));
            $this->_redirect('helloworld/subscription');

        }else{

            $this->saveSubscription();
        }

    }


    public function saveSubscription()
    {
        $data = $this->getRequest()->getPost();
        $subscription = $this->_objectManager->create('Learning\FirstUnit\Model\Subscription');
        $subscription->setFirstname($data['firstname']);
        $subscription->setLastname($data['lastname']);
        $subscription->setEmail($data['email']);
        $subscription->save();

        $this->messageManager->addSuccess(__('You saved subscriber success'));
        $this->_redirect('helloworld/subscription');
    }

    public function editSubscription() {

    }

}