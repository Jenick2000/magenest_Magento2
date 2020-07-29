<?php

namespace Magenest\Cybergame\Controller\Adminhtml\Cybergame;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;

class RoomExtraOption extends Action
{

    /**
     * @var PageFactory
     */
    protected $pageFactory;

    public function __construct(Action\Context $context, PageFactory $pageFactory)
    {
        $this->pageFactory = $pageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->pageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend('Room Extra Option List');
        return $resultPage;
    }
}
