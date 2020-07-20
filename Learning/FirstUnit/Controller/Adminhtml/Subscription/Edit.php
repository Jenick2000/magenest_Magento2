<?php
 namespace Learning\FirstUnit\Controller\Adminhtml\Subscription;
 use Magento\Backend\App\Action;
 use Magento\Framework\View\Result\PageFactory;
 class Edit extends Action {

     protected $resultEditPageFactory;

     public function __construct(Action\Context $context, PageFactory $resultEditPageFactory)
     {
         $this->resultEditPageFactory = $resultEditPageFactory;
         parent::__construct($context);
     }

     public function execute()
     {
         // TODO: Implement execute() methodd
         $id = $this->getRequest()->getParam('id');
         $subscription = $this->_objectManager->create('Learning\FirstUnit\Model\Subscription');
         if($subscription->load($id)->getData()) {
             return $this->resultEditPageFactory->create();
         }else{
             exit('Not Found');
         }


     }
 }