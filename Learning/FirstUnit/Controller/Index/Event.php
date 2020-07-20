<?php
namespace Learning\FirstUnit\Controller\Index;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Event extends Action {

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    public function __construct(Context $context, PageFactory $resultPageFactory)
    {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);

    }

    public function execute()
    {
        $parameters = [
                    'product' => $this->_objectManager->create('Magento\Catalog\Model\Product')->load(50),
                    'category' => $this->_objectManager ->create('Magento\Catalog\Model\Product')->load(10),
        ];
        $this->_eventManager->dispatch('helloworld_register_visit',$parameters);
        return $this->resultPageFactory->create();
    }
}