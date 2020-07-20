<?php
namespace Learning\FirstUnit\Controller\Adminhtml\Index;

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
protected function _isAllowed()
{
    return $this->_authorization->isAllowed('Learning_FirstUnit::index_view');
}

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        return $resultPage;
        //exit('view page';at
    }
}