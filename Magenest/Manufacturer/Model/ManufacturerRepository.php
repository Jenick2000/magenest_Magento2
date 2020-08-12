<?php

namespace Magenest\Manufacturer\Model;

use Magenest\Manufacturer\Api\Data\ManufacturerInterface;
use Magento\TestFramework\Exception\NoSuchActionException;
use Magento\Framework\Serialize\SerializerInterface;

class ManufacturerRepository implements \Magenest\Manufacturer\Api\ManufacturerRepositoryInterface
{

    /**
     * @var ManufacturerFactory
     */
    protected $_manufacturerFactory;
    /**
     * @var ResourceModel\Manufacturer\CollectionFactory
     */
    protected $_collectionFactory;
    /**
     * @var ResourceModel\Manufacturer
     */
    protected $resoureModel;
    /**
     * @var \Magento\Framework\Event\ManagerInterface
     */
    protected $_eventManager;

    private $instancesById = [];
    /**
     * @var \Magento\Framework\App\Cache
     */
    private $_cache;
    private $cacheId = 'ManufacturerCacheForLoad';
    /**
     * @var SerializerInterface
     */
    protected $serializer;

    public function __construct(\Magento\Framework\Model\Context $context,
                                \Magento\Framework\App\Cache $cache,
                                SerializerInterface $serializer,
                                \Magenest\Manufacturer\Model\ManufacturerFactory $manufacturerFactory,
                                \Magenest\Manufacturer\Model\ResourceModel\Manufacturer $resourModel,
                                \Magenest\Manufacturer\Model\ResourceModel\Manufacturer\CollectionFactory $collectionFactory
    )
    {
        $this->_manufacturerFactory = $manufacturerFactory;
        $this->_collectionFactory = $collectionFactory;
        $this->_eventManager = $context->getEventDispatcher();
        $this->resoureModel = $resourModel;
        $this->_cache = $cache;
        $this->serializer = $serializer;
    }

    public function getById($id, $forceReload = false)
    {

        if (!$this->_cache->load($this->cacheId) || $forceReload) {
            $manufacturer = $this->_manufacturerFactory->create();
            $manufacturer->getResource()->load($manufacturer, $id); //= $this->resoureModel->load($manufacturerIns, $id);
            if ($manufacturer->getId()) {
                $this->instancesById = $manufacturer->getData();
                $this->cacheManufacturer($manufacturer);
                return $manufacturer;
            } else {
                return null;
            }
        }
        $data = $this->_cache->load($this->cacheId);
        $data = $this->serializer->unserialize($data);
        return $data;
    }

    public function cacheManufacturer($manufacturer)
    {
        $data = $this->serializer->serialize($manufacturer->getData());
        $this->_cache->save($data, $this->cacheId);
    }

    public function save($manufacturer)
    {
        $this->resoureModel->save($manufacturer);
        return $manufacturer;
    }

    public function delete($manufacturer)
    {
        $this->resoureModel->delete($manufacturer);
    }

    public function getList()
    {
        $manufacturers = $this->_collectionFactory->create();
        return $manufacturers;
    }
}