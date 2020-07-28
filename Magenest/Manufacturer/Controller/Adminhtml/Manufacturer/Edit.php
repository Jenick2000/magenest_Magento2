<?php

namespace Magenest\Manufacturer\Controller\Adminhtml\Manufacturer;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;

class Edit extends Action
{
    /**
     * @var \Magenest\Manufacturer\Model\ManufacturerFactory
     */
    protected $manufacturerFactory;
    /**
     * @var PageFactory
     */
    protected $pagaFactory;

    public function __construct(Action\Context $context, PageFactory $pageFactory, \Magenest\Manufacturer\Model\ManufacturerFactory $manufacturerFactory)
    {
        $this->manufacturerFactory = $manufacturerFactory;
        $this->pagaFactory = $pageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $manufactorer_id = $this->getRequest()->getParam('id');
        $manufacturer = $this->manufacturerFactory->create();
        $manufacturer->load($manufactorer_id);
        $resultPage = $this->pagaFactory->create();
        $resultPage->getConfig()->getTitle()->prepend($manufacturer->getName());

        return $resultPage;
    }
}