<?php

namespace Learning\FirstUnit\Controller\Index;


class Index extends \Magento\Framework\App\Action\Action
{

    protected $_resultPageFactory;

    function __construct(\Magento\Framework\App\Action\Context $context, \Magento\Framework\View\Result\PageFactory $resultPageFactory)
    {
        $this->_resultPageFactory = $resultPageFactory;
        return parent::__construct($context);
    }

    function execute()
    {

        return $this->_resultPageFactory->create();
         //$this->_forward('Index', 'GamerAccount', 'cybergame'); //chuyen huong action ma khong thay doi redirect tren brower

    }
}