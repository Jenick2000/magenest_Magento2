<?php
namespace Magenest\Movie\Controller\Adminhtml\Actor;
use Magenest\Movie\Model\ActorFactory;
use Magento\Backend\App\Action;

class Remove extends \Magento\Backend\App\Action{

    /**
     * @var ActorFactory
     */
    protected $actorFactory;

    public function __construct(Action\Context $context, ActorFactory $actorFactory)
    {
        $this->actorFactory = $actorFactory;
        parent::__construct($context);

    }

    public function execute()
    {
     $id = $this->getRequest()->getParam('id');
     $actor = $this->actorFactory->create();
     if($actor->load($id)->getId()) {
        $actor->delete();
        $this->_redirect('magenest/actor');
        $this->messageManager->addSuccessMessage('You removed actor');
     }else{
         $this->_redirect('magenest/actor');
         $this->messageManager->addErrorMessage('Not found actor to remove !');
     }
    }
}