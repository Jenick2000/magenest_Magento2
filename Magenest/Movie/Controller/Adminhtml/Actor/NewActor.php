<?php
namespace Magenest\Movie\Controller\Adminhtml\Actor;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
class NewActor extends \Magento\Framework\App\Action\Action
{

    /**
     * @var PageFactory
     */
    protected $pageFactory;

    public function __construct(Context $context, PageFactory $pageFactory)
    {
        $this->pageFactory = $pageFactory;
        parent::__construct($context);
    }

    public function execute()
   {
        $resultPage = $this->pageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend('New Actor');
        return $resultPage;
//    exit('ok');
        }
}