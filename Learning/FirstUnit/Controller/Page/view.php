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
        $this->_view->loadLayout();
        $this->_view->getPage()->getConfig()->getTitle()->prepend('Who are you ?');
        $this->_view->renderLayout();
    }
}