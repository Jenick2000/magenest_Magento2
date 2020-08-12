<?php

namespace Magenest\Manufacturer\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class ManufacturerObserver implements ObserverInterface
{
    /**
     * @var \Magenest\Manufacturer\Model\ManufacturerRepository
     */
    protected $_manufacturerRepository;

    public function __construct(\Magenest\Manufacturer\Model\ManufacturerRepository $manufacturerRepository)
    {
        $this->_manufacturerRepository = $manufacturerRepository;
    }

    public function execute(Observer $observer)
    {
        $manufacturer = $observer->getData('object');
        if ($manufacturer instanceof \Magenest\Manufacturer\Model\Manufacturer) {
            $manufacturer->setName('JenTech');
        }

    }
}