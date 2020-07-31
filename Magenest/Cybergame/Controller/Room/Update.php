<?php

namespace Magenest\Cybergame\Controller\Room;

use Magento\Framework\App\Action\Action;

class Update extends Action
{

    public function execute()
    {

        $this->_view->loadLayout();
        $this->_view->getPage()->getConfig()->getTitle()->set(__('Update Room Info'));
        $this->_view->renderLayout();
    }
}