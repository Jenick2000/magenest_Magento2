<?php

namespace Learning\FirstUnit\Controller\Page;

use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\View\Result\PageFactory;


class view extends  Action{

   // protected $resultJsonFactory;
    protected $_resultPageFactory;
    function __construct(Context $context, PageFactory $resultPageFactory)
    {
        $this->_resultPageFactory= $resultPageFactory;
        return parent::__construct($context);
    }

    function execute()
    {
        // TODO: Implement execute() method.
        return $this->_resultPageFactory->create();

    }
}