<?php
namespace  Learning\FirstUnit\Controller\Adminhtml\Subscription;

use Magento\Backend\App\Action;

class Delete extends Action {

    public function execute()
    {
        // TODO: Implement execute() method.
        $id = $this->getRequest()->getParam('id');
       $collection =  $this->_objectManager->create('Learning\FirstUnit\Model\Subscription');
       if($collection->load($id)->getId()) {
           try {
               $collection->delete();
               $this->messageManager->addSuccess(__('You deleted subscriber success'));
               $this->_redirect('helloworld/subscription');
           }catch (\Zend_Exception $err){
               $this->messageManager->addError(__("Can't delete this subscription!"));
           }
       }
    }
}
