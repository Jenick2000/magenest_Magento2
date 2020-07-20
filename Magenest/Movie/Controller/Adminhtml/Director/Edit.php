<?php
namespace Magenest\Movie\Controller\Adminhtml\Director;

use Magento\Backend\App\Action;
class Edit extends Action {

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;



    public function __construct(Action\Context $context, \Magento\Framework\View\Result\PageFactory $pageFactory)
    {
        $this->_pageFactory = $pageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->_pageFactory->create();
        $director_id = $this->getRequest()->getParam('id');

        $collection = $this->_objectManager->create('Magenest\Movie\Model\Director');
       if( $collection->load($director_id)->getId()) {
           $resultPage->getConfig()->getTitle()->prepend($collection->getName());
           return $resultPage;
       }else{
           exit('Not Found');
       }

    }
}