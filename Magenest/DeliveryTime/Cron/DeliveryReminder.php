<?php
namespace Magenest\DeliveryTime\Cron;

use Laminas\Http\Header\Date;

class DeliveryReminder {

    protected $deliveryHelper;
    protected $_orderCollectionFactory;
    protected $date;
    protected $_resource;

    public function __construct(
        \Magenest\DeliveryTime\Helper\Delivery $deliveryHelper,
        \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory,
        \Magento\Framework\Stdlib\DateTime\DateTime $date,
        \Magento\Framework\App\ResourceConnection $resource
    )
    {
        $this->_orderCollectionFactory = $orderCollectionFactory;
        $this->deliveryHelper = $deliveryHelper;
        $this->date = $date;
        $this->_resource = $resource;
    }

    /**
     * delivery time reminder
     */
    public function execute() {

        $today = $this->date->gmtDate('m/d/Y');
        $collection = $this->_orderCollectionFactory->create()
            ->addAttributeToSelect('*')
            ->addFieldToFilter('status', 'pending')
            ->addFieldToFilter('delivery_reminder', '0')
            ->addFieldToFilter('delivery_date', $today);

        foreach ($collection->getItems() as $order) {
            if($this->checkTimeBefore($order->getDeliveryTime())) {
                $this->deliveryHelper->sendEmail('jenick2000@gmail.com', []);
                $this->updateOrder($order->getId());
            }
        }
    }

    /**
     * @param $time
     * @return bool
     */
    public function checkTimeBefore($time){
        $hour = $this->date->gmtDate('H');
        $interval = explode('-', $time);
        $timeFrom = $interval[0];
        if($timeFrom == $hour)
            return true;

        return false;

    }

    /**
     * @param $orderId
     */
    public function updateOrder($orderId) {
        $connection = $this->_resource->getConnection();
        $tableName = $this->_resource->getTableName('sales_order');
        $connection->update($tableName, ['delivery_reminder' => 1], ["entity_id = ?" => $orderId]);
    }
}