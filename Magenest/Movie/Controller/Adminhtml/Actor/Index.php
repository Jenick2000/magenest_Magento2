<?php
namespace Magenest\Movie\Controller\Adminhtml\Actor;


use Magento\Framework\App\Action\Context;

class Index extends \Magento\Framework\App\Action\Action {

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $pageFactory;

    public function __construct(Context $context, \Magento\Framework\View\Result\PageFactory $pageFactory)
    {
        $this->pageFactory = $pageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
       $resultPage = $this->pageFactory->create();
       $resultPage->getConfig()->getTitle()->prepend(__('Actor'));
       return $resultPage;
    }
}