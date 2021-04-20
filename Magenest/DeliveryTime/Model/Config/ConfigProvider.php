<?php
namespace Magenest\DeliveryTime\Model\Config;

use Magento\Checkout\Model\ConfigProviderInterface;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Store\Model\ScopeInterface;

class ConfigProvider implements ConfigProviderInterface {
    const XML_PATH_MINIMAL_DELIVERY_INTERVAL = 'delivery_time/delivery_time_config/minimal_delivery_interval';
    const XML_PATH_MAXIMAL_DELIVERY_INTERVAL = 'delivery_time/delivery_time_config/maximal_delivery_interval';
    protected $scopeConfig;
    protected $deliveryTimeCollectionFactory;
    protected $_storeManager;
    protected $_customerSession;
    protected $serializer;

    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Customer\Model\Session $customerSession,
        Json $serializer,
        \Magenest\DeliveryTime\Model\ResourceModel\DeliveryTime\CollectionFactory $deliveryTimeCollectionFactory
    ){
        $this->scopeConfig = $scopeConfig;
        $this->_storeManager = $storeManager;
        $this->_customerSession = $customerSession;
        $this->serializer = $serializer;
        $this->deliveryTimeCollectionFactory = $deliveryTimeCollectionFactory;
    }

    public function getConfig()
    {
        $minimal_delivery_interval = $this->scopeConfig->getValue(self::XML_PATH_MINIMAL_DELIVERY_INTERVAL, ScopeInterface::SCOPE_STORE);
        $maximal_delivery_interval = $this->scopeConfig->getValue(self::XML_PATH_MAXIMAL_DELIVERY_INTERVAL, ScopeInterface::SCOPE_STORE);
        $deliveryTimes = $this->getDeliveryTimes();
        return [
            'deliveryTime' => [
                'minimal_delivery_interval' => $minimal_delivery_interval,
                'maximal_delivery_interval' => $maximal_delivery_interval,
                'deliveryTimeOptions'       => $deliveryTimes
            ]
        ];
    }

    public function getDeliveryTimes() {

        $store = $this->_storeManager->getStore()->getId();
        $customerGroup = $this->getGroupId();
        $options = [];
        $deliveryTimes = $this->deliveryTimeCollectionFactory->create()
                                ->addFieldToFilter('customer_group_id',['like' => '%"'.$customerGroup.'"%'])
                                ->addFieldToFilter('store_id', [['like' => '%"'.$store.'"%'], ['like' => '"0"']]);

        foreach ($deliveryTimes->getItems() as $item) {
            $times = $this->serializer->unserialize($item->getTimes());
            foreach ($times as $time) {
                $timeFrom = $time['time_from'] < 10 ? '0'.$time['time_from'] . ' : 00': $time['time_from']. ' : 00';
                $timeTo   = $time['time_to'] < 10 ? '0'.$time['time_to'] . ' : 00': $time['time_to']. ' : 00';
                $label    = $timeFrom . ' - ' . $timeTo;
                $options[] = ['value' => $time['time_from'].'-'.$time['time_to'], 'label' => $label];
            }

        }

        return $options;
    }

    public function getGroupId(){

        if($this->_customerSession->isLoggedIn()){
            return $this->_customerSession->getCustomer()->getGroupId();
        }
        return \Magento\Customer\Model\Group::NOT_LOGGED_IN_ID;
    }

}