<?php
namespace Magenest\Movie\Model\Config\Backend;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magenest\Movie\Model\ResourceModel\Movie\CollectionFactory;
class Movie extends \Magento\Framework\App\Config\Value{

    /**
     * @var CollectionFactory
     */
    protected $_collectionFactory;


    public function __construct(\Magento\Framework\Model\Context $context,
                                \Magento\Framework\Registry $registry,
                                ScopeConfigInterface $config,
                                 CollectionFactory $collectionFactory,
                                \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList,
                                \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
                                \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
                                array $data = []
    )
    {
        $this->_collectionFactory = $collectionFactory;
        parent::__construct($context, $registry, $config, $cacheTypeList, $resource, $resourceCollection, $data);
    }

    protected function _afterLoad()
  {
      $movies = $this->_collectionFactory->create();
      $movies->getData();
      $total = count($movies);
      $this->setValue($total);
      return parent::_afterLoad(); // TODO: Change the autogenerated stub
  }

}