<?php
 namespace Learning\FirstUnit\Controller\Adminhtml\Subscription;

 use Magento\Backend\App\Action;
 use Magento\Framework\View\Result\PageFactory;



 class Add extends  Action{

     protected $resultPageFactory;

     public function __construct(Action\Context $context, PageFactory $resultPageFactory)
     {
         $this->resultPageFactory = $resultPageFactory;
         parent::__construct($context);
     }


     public function execute()
     {
         // TODO: Implement execute() method.
         $resultPage = $this->resultPageFactory->create();
         $resultPage->getConfig()->getTitle()->prepend(__('Add New Subscriptions'));
         return $resultPage;
     }
 }
