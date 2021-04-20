<?php
namespace Magenest\DeliveryTime\Ui\Component\Listing\DeliveryTime\Columns;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use \Magento\Customer\Model\ResourceModel\Group\Collection as CustomerGroupCollection;

class CustomerGroup extends Column {

    /**
     * @var CustomerGroupCollection
     */
    protected $_customerGroup;
    protected $_customerGroupCache;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        CustomerGroupCollection $customerGroupCollection,
        array $components = [],
        array $data = []
    )
    {
        $this->_customerGroup = $customerGroupCollection;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource) {

        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $item['customer_group_id'] = $this->getCustomerGroup($item['customer_group_id']);
            }
        }
        return parent::prepareDataSource($dataSource);
    }

    public function getCustomerGroup($customerGroupIds) {

        if(!$customerGroupIds)
            return __('All Group');
        if(!$this->_customerGroupCache) {
            $this->_customerGroupCache = $this->_customerGroup->getItems();
        }
        $customerGroupIds = str_replace('"', "", $customerGroupIds);
        $customerGroup = explode(',', $customerGroupIds);
        if(count($customerGroup) == count($this->_customerGroupCache))
            return __('All Group');

        $groupScope = '';
        foreach ($customerGroup as $group) {
            $groupScope .= $this->_customerGroupCache[$group]->getCode() . ', ';
        }

        return rtrim($groupScope, ', ');
    }
}
