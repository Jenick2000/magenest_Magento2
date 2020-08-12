<?php

namespace Magenest\Manufacturer\Controller\Adminhtml\Manufacturer;

use Magento\Backend\App\Action;

class Save extends Action
{


    /**
     * @var \Magenest\Manufacturer\Model\ManufacturerRepository
     */
    protected $_manufacturerRepository;
    /**
     * @var \Magenest\Manufacturer\Model\ManufacturerFactory
     */
    protected $ManufacturerFactory;

    public function __construct(Action\Context $context,
                                \Magenest\Manufacturer\Model\ManufacturerRepository $manufacturerRepository,
                                \Magenest\Manufacturer\Model\ManufacturerFactory $manufacturerFactory
    )
    {
        $this->_manufacturerRepository = $manufacturerRepository;
        $this->ManufacturerFactory = $manufacturerFactory;
        parent::__construct($context);
    }

    public
    function execute()
    {
        $data = $this->getRequest()->getPost();

        $repo = $this->_manufacturerRepository;
        $manufacturer = $repo->getById($data['manufacturer_id'], true);

        if ($manufacturer) {
            $manufacturer->setName($data['name']);
            $manufacturer->setAddressCity($data['address_city']);
            $manufacturer->setAddressStreet($data['address_street']);
            $manufacturer->setAddressCountry($data['address_country']);
            $manufacturer->setContactName($data['contact_name']);
            $manufacturer->setContactPhone($data['contact_phone']);
            $repo->save($manufacturer);
            $this->messageManager->addSuccessMessage('You saved manufacturer');
            $this->_redirect('*/*/index');
        } else {
            $this->saveData($data);
        }

    }

    public function saveData($data)
    {
        $repo = $this->_manufacturerRepository;
        $manufacturer = $this->ManufacturerFactory->create();
        $manufacturer->setName($data['name']);
        $manufacturer->setAddressCity($data['address_city']);
        $manufacturer->setAddressStreet($data['address_street']);
        $manufacturer->setAddressCountry($data['address_country']);
        $manufacturer->setContactName($data['contact_name']);
        $manufacturer->setContactPhone($data['contact_phone']);
       $repo->save($manufacturer);
        $this->messageManager->addSuccessMessage('You saved manufacturer');
        $this->_redirect('*/*/index');
    }
}