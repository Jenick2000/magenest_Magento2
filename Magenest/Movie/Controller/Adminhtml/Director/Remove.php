<?php
namespace Magenest\Movie\Controller\Adminhtml\Director;

class Remove extends \Magento\Framework\App\Action\Action {

    public function execute()
    {
        $director_id = $this->getRequest()->getParam('id');
        $director  = $this->_objectManager->create('Magenest\Movie\Model\Director');
        if($director->load($director_id)->getId()){
            $director->delete();
            $this->_redirect('magenest/director');
            $this->messageManager->addSuccessMessage('you removed director');
        }else{
            $this->_redirect('magenest/director');
            $this->messageManager->addErrorMessage("Can't remove director");
        }
    }
}