<?php

namespace Magenest\Movie\Model\ResourceModel\Movie;

use  Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

use Magento\Framework\Data\Collection\EntityFactoryInterface;
use Psr\Log\LoggerInterface;
use Magento\Framework\Data\Collection\Db\FetchStrategyInterface;
use Magento\Framework\Event\ManagerInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Collection extends AbstractCollection {

    protected $_idFieldName = 'movie_id';
    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    public function __construct(
        EntityFactoryInterface $entityFactory,
        LoggerInterface $logger,
        FetchStrategyInterface $fetchStrategy,
        ManagerInterface $eventManager,
        StoreManagerInterface $storeManager,
        AdapterInterface $connection = null,
        AbstractDb $resource = null
    )
    {
        $this->_init('Magenest\Movie\Model\Movie', 'Magenest\Movie\Model\ResourceModel\Movie');

        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $connection, $resource);
        $this->storeManager = $storeManager;
    }

//    protected function _initSelect()
//    {
//        parent::_initSelect();
//
//        $this->getSelect()->join(
//            ['secondTable' => $this->getTable('magenest_director')], //2nd table name by which you want to join mail table
//            'main_table.director_id = secondTable.director_id', // common column which available in both table
//            '*' // '*' define that you want all column of 2nd table. if you want some particular column then you can define as ['column1','column2']
//        );
//        return $this;
//    }
}