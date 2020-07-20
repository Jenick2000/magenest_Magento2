<?php

namespace Learning\FirstUnit\Controller\Adminhtml\Page;

use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;

class View extends Action {
    protected $resultPageFactory;

    public function __construct(Context $context, PageFactory $resultPageFactory)
    {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        // TODO: Implement execute() method.
        return $this->resultPageFactory->create();

    }

    protected function _isAllowed()
    {
       return $this->_authorization->isAllowed('Learning_FirstUnit::page');
    }
}