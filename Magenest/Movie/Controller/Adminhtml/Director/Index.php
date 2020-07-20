<?php

namespace Magenest\Movie\Controller\Adminhtml\Director;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Backend\App\Action{

    /**
     * @var PageFactory
     */
    protected $_pageFactory;

    public function __construct(Action\Context $context, PageFactory $pageFactory)
    {
        $this->_pageFactory = $pageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
      $page = $this->_pageFactory->create();
      $page->getConfig()->getTitle()->prepend(__('Directors'));
      return $page;
    }
}