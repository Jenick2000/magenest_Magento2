<?php

namespace Learning\FirstUnit\Controller\Page;

use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\View\Result\PageFactory;


class view extends Action
{

    function execute()
    {
        // TODO: Implement execute() method.
        $this->_view->loadLayout();
        $this->_view->getPage()->getConfig()->getTitle()->prepend('Hello world');
        $this->_view->renderLayout();
    }
}