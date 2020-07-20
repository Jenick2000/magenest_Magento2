<?php

namespace Magenest\Movie\Controller\Adminhtml\Movie;
use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;

class Edit extends Action {

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
        $resultPage->getConfig()->getTitle()->prepend(__('Edit Movie'));
        return $resultPage;
    }
}