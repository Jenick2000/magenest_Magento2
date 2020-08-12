<?php

namespace Magenest\Manufacturer\Controller\Adminhtml\Manufacturer;

use Magento\Backend\App\Action;

class Remove extends Action
{

    /**
     * @var \Magenest\Manufacturer\Model\ManufacturerRepository
     */
    protected $_manufacturerRepository;

    public function __construct(Action\Context $context, \Magenest\Manufacturer\Model\ManufacturerRepository $manufacturerRepository)
    {
        $this->_manufacturerRepository = $manufacturerRepository;
        parent::__construct($context);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $repo = $this->_manufacturerRepository;
        if ($repo->getById($id, true)) {
            $manufacturer = $repo->getById($id, true);
            $repo->delete($manufacturer);
            $this->_redirect('magenest/manufacturer');
            $this->messageManager->addSuccessMessage('You removed Manufacturer');
        } else {
            $this->_redirect('magenest/manufacturer');
            $this->messageManager->addErrorMessage('Not found Manufacturer to remove !');
        }
    }
}