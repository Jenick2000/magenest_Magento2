<?php

namespace Magenest\Movie\Model\Config\Backend;


use Magento\Framework\App\Config\ScopeConfigInterface;
use Magenest\Movie\Model\ResourceModel\Actor\CollectionFactory;

class Actor extends \Magento\Framework\App\Config\Value
{

    /**
     * @var CollectionFactory
     */
    protected $_colltionFactory;

    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        ScopeConfigInterface $config,
        CollectionFactory $collectionFactory,
        \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = [])
    {
        $this->_colltionFactory = $collectionFactory;
        parent::__construct($context, $registry, $config, $cacheTypeList, $resource, $resourceCollection, $data);
    }

    protected function _afterLoad()
    {

        $actors = $this->_colltionFactory->create();
        $actors->getData();
        $this->setValue(count($actors));
        return parent::_afterLoad();
    }

}