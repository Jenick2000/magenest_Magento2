<?php
namespace Magenest\DeliveryTime\Ui\Component\Listing\Order\Columns;

use Magento\Ui\Component\Listing\Columns\Column;

class DeliveryDate extends Column {

    public function prepareDataSource(array $dataSource) {

        if (isset($dataSource['data']['items'])) {
//            foreach ($dataSource['data']['items'] as & $item) {
//                $item['delivery_date'] = 'Jenick';
//            }
        }
        return parent::prepareDataSource($dataSource);
    }
}
