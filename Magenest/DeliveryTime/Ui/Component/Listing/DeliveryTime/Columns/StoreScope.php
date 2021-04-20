<?php
namespace Magenest\DeliveryTime\Ui\Component\Listing\DeliveryTime\Columns;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Store\Model\StoreManagerInterface as StoreManager;
use Magento\Ui\Component\Listing\Columns\Column;

class StoreScope extends Column {

    /**
     * @var StoreManager
     */
    protected $storeManager;

    protected $_stores;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        StoreManager $storeManager,
        array $components = [],
        array $data = []
    )
    {
        $this->storeManager = $storeManager;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource) {

        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {

                $item['store_id'] = $this->getStoreView($item['store_id']);
            }
        }
        return parent::prepareDataSource($dataSource);
    }

    public function getStoreView($storeIds) {
        if(!$storeIds)
            return __('All Stores');
        if(!$this->_stores) {
            $this->_stores = $this->storeManager->getStores();
        }
        $storeIds = str_replace('"', "", $storeIds);
        $stores = explode(',', $storeIds);
        if(count($stores) == count($this->_stores) || $stores[0] == "0")
            return __('All Stores');

        $storeScope = '';
        foreach ($stores as $store) {
            $storeScope .= $this->_stores[$store]->getName() . ', ';
        }

        return rtrim($storeScope, ', ');
    }


}
