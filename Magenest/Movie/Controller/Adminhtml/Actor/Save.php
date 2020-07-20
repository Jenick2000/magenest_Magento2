<?php
namespace Magenest\Movie\Controller\Adminhtml\Actor;

use Magento\Backend\App\Action;

class Save extends \Magento\Backend\App\Action {

    /**
     * @var \Magenest\Movie\Model\ActorFactory
     */
    protected $_actorFactory;

    public function __construct(Action\Context $context, \Magenest\Movie\Model\ActorFactory $actorFactory)
    {
        $this->_actorFactory = $actorFactory;
        parent::__construct($context);
    }

    public function execute()
    {

        $data = $this->getRequest()->getPost();
        $actor = $this->_actorFactory->create();

        if($actor->load($data['actor_id'])->getId()){
            $actor->setName($data['name']);
            $actor->save();
            $this->_redirect('magenest/actor');
            $this->messageManager->addSuccessMessage('You saved actor');
        }else{
            $this->addActor();
        }
    }

    public function addActor() {
        $data = $this->getRequest()->getPost();
        $actor = $this->_actorFactory->create();
        $actor->setName($data['name']);
        $actor->save();
        $this->_redirect('magenest/actor');
        $this->messageManager->addSuccessMessage('You saved actor');
    }
}
