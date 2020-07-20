<?php
namespace Magenest\Movie\Controller\Adminhtml\Director;


class Save extends \Magento\Framework\App\Action\Action {



    public function execute()
    {
        $data = $this->getRequest()->getPost();
        $director  = $this->_objectManager->create('Magenest\Movie\Model\Director');

        if( $director->load($data['director_id'])->getId()) {
            $director->setName($data['name']);
            $director->save();

            $this->_redirect('magenest/director');
            $this->messageManager->addSuccessMessage('You saved Director');
        }else{
            $this->addNewDirector();
        }
    }

    public function addNewDirector() {
        $data = $this->getRequest()->getPost();
        $director  = $this->_objectManager->create('Magenest\Movie\Model\Director');
        $director->setName($data['name']);
        $director->save();

        $this->_redirect('magenest/director');
        $this->messageManager->addSuccessMessage('You saved Director');
    }
}
