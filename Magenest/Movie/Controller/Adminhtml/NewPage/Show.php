<?php
namespace Magenest\Movie\Controller\Adminhtml\NewPage;



use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;


class Show extends \Magento\Backend\App\Action {

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
        return $this->pageFactory->create();
    }
    protected function _isAllowed()
    {
        return parent::_isAllowed();
        return $this->_authorization->isAllowed('Magenest_Movie::magenest_movie');
    }
}