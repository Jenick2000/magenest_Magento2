<?php
namespace Magenest\Movie\Model\ResourceModel\Movie\Grid;


use Magenest\Movie\Model\ResourceModel\Movie\Collection as MovieCollection;
use  Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

use Magento\Framework\Data\Collection\EntityFactoryInterface;
use Psr\Log\LoggerInterface;
use Magento\Framework\Data\Collection\Db\FetchStrategyInterface;
use Magento\Framework\Event\ManagerInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Api\Search\SearchResultInterface;
use Magento\Framework\Api\Search\AggregationInterface;

class Collection extends MovieCollection implements SearchResultInterface {
    /**
     * @var AggregationInterface
     */
    protected $aggregations;

    /**
     * Resource initialization
     * @param EntityFactoryInterface $entityFactory ,
     * @param LoggerInterface $logger ,
     * @param FetchStrategyInterface $fetchStrategy ,
     * @param ManagerInterface $eventManager ,
     * @param StoreManagerInterface $storeManager ,
     * @param String $mainTable ,
     * @param String $eventPrefix ,
     * @param String $eventObject ,
     * @param String $resourceModel ,
     * @param string $model = 'Magento\Framework\View\Element\UiComponent\DataProvider\Document',
     * @param AdapterInterface $connection = null,
     * @param AbstractDb $resource = null
     */


public function __construct(EntityFactoryInterface $entityFactory,
                            LoggerInterface $logger,
                            FetchStrategyInterface $fetchStrategy,
                            ManagerInterface $eventManager,
                            StoreManagerInterface $storeManager,
                            $mainTable,
                            $eventPrefix,
                            $eventObject,
                            $resourceModel,
                            $model = 'Magento\Framework\View\Element\UiComponent\DataProvider\Document',
                            AdapterInterface $connection = null,
                            AbstractDb $resource = null)
{

       $this->_eventPrefix = $eventPrefix;
        $this->_eventObject = $eventObject;
        $this->_init($model, $resourceModel);
        $this->setMainTable($mainTable);
    parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $storeManager, $connection, $resource);
}

    /**
     * @return AggregationInterface
     */
    public function getAggregations()
    {
        return $this->aggregations;
    }

    /**
     * @param AggregationInterface $aggregations
     *
     * @return void
     */
    public function setAggregations($aggregations)
    {
        $this->aggregations = $aggregations;
    }

    /**
     * Get search criteria.
     *
     * @return \Magento\Framework\Api\SearchCriteriaInterface|null
     */
    public function getSearchCriteria()
    {
        return null;
    }

    /**
     * Set search criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     *
     * @return $this
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function setSearchCriteria(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria = null
    ) {
        return $this;
    }

    /**
     * Get total count.
     *
     * @return int
     */
    public function getTotalCount()
    {
        return $this->getSize();
    }

    /**
     * Set total count.
     *
     * @param int $totalCount
     *
     * @return $this
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function setTotalCount($totalCount)
    {
        return $this;
    }

    /**
     * Set items list.
     *
     * @param \Magento\Framework\Api\ExtensibleDataInterface[] $items
     *
     * @return $this
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function setItems(array $items = null)
    {
        return $this;
    }

}