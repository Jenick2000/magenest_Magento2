<?php
namespace Magenest\Attachments\Controller\Adminhtml\Attachments;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;

class Index extends Action {


    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->setActiveMenu('Magenest_Attachments::listing');
        $resultPage->getConfig()->getTitle()->prepend(__('Attachments Management'));
        return $resultPage;
    }
}
