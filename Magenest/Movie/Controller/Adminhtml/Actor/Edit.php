<?php
namespace  Magenest\Movie\Controller\Adminhtml\Actor;

use Magento\Framework\App\Action\Context;

class Edit extends \Magento\Framework\App\Action\Action {
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
        $id = $this->getRequest()->getParam('id');
        $actor = $this->_objectManager->create('Magenest\Movie\Model\Actor');
        $actor->load($id);

        $resultPage->getConfig()->getTitle()->prepend($actor->getName());
        return $resultPage;
    }
}