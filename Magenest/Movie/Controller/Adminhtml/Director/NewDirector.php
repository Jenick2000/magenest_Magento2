<?php
namespace Magenest\Movie\Controller\Adminhtml\Director;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
class NewDirector extends \Magento\Framework\App\Action\Action {

    /**
     * @var PageFactory
     */
    protected $_pageFactory;

    public function __construct(Context $context, PageFactory $pageFactory)
    {
        $this->_pageFactory = $pageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
       $resultPage = $this->_pageFactory->create();
       $resultPage->getConfig()->getTitle()->prepend('New Director');
       return $resultPage;
    }
}