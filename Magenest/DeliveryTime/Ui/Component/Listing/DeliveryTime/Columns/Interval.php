<?php
namespace Magenest\DeliveryTime\Ui\Component\Listing\DeliveryTime\Columns;

use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use \Magento\Customer\Model\ResourceModel\Group\Collection as CustomerGroupCollection;

class Interval extends Column {


    protected $serializer;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        Json $serializer,
        array $components = [],
        array $data = []
    )
    {
        $this->serializer = $serializer;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource) {

        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $item['times'] = $this->convertInterval($item['times']);
            }
        }
        return parent::prepareDataSource($dataSource);
    }

    public function convertInterval($interval) {
        $interval = $this->serializer->unserialize($interval);
        $intervalStr = '';
        foreach ($interval as $time) {
            $intervalStr .= $time['time_from'].'h - '. $time['time_to'].'h, ';
        }
        return rtrim($intervalStr, ', ');
    }

}
