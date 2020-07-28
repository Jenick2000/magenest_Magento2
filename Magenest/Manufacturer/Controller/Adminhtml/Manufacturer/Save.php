<?php

namespace Magenest\Manufacturer\Controller\Adminhtml\Manufacturer;

use Magenest\Manufacturer\Model\ManufacturerFactory;
use Magento\Backend\App\Action;

class Save extends Action
{

    /**
     * @var ManufacturerFactory
     */
    protected $manufacturerFactory;

    public function __construct(Action\Context $context, ManufacturerFactory $manufacturerFactory)
    {
        $this->manufacturerFactory = $manufacturerFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->getRequest()->getPost();
        $manufacturer = $this->manufacturerFactory->create();
        if ($manufacturer->load($data['manufacturer_id'])->getId()) {
            $this->saveData($manufacturer, $data);
        } else {
            $this->saveData($manufacturer, $data);
        }

    }

    public function saveData($manufacturer, $data)
    {
        $manufacturer->setName($data['name']);
        $manufacturer->setAddressCity($data['address_city']);
        $manufacturer->setAddressStreet($data['address_street']);
        $manufacturer->setAddressCountry($data['address_country']);
        $manufacturer->setContactName($data['contact_name']);
        $manufacturer->setContactPhone($data['contact_phone']);
        $manufacturer->save();
        $this->messageManager->addSuccessMessage('You saved manufacturer');
        $this->_redirect('*/*/index');
    }
}