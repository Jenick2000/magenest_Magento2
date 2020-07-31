<?php

namespace Magenest\Cybergame\Controller\Room;

use Magento\Framework\App\Action\Action;

class Edit extends Action
{

    public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->getPage()->getConfig()->getTitle()->set(__('Edit Room Extra option'));
        $this->_view->renderLayout();

    }
}