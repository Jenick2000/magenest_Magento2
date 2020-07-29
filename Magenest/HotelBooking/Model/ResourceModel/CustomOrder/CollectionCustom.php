<?php

namespace Magenest\HotelBooking\Model\ResourceModel\CustomOrder;

use Magento\Sales\Model\ResourceModel\Order\Collection;

class CollectionCustom extends Collection
{

    protected function _renderFiltersBefore()
    {
        $this->getSelect()
            ->join(array('order_item' => 'sales_order_item'),
                'order_item.order_id = main_table.entity_id', array('order_item.sku', 'order_item.name'))
            ->join(array('product_item' => 'catalog_product_entity'),
                'product_item.entity_id = order_item.product_id');

        parent::_renderFiltersBefore();
    }
}//