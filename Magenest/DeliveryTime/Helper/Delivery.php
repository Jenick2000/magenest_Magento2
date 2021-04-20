<?php
namespace Magenest\DeliveryTime\Helper;

use Magento\Framework\App\Helper\Context;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\Serialize\Serializer\Json;
use Magenest\DeliveryTime\Model\ResourceModel\DeliveryTime\CollectionFactory;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Store\Model\ScopeInterface;

class Delivery extends \Magento\Framework\App\Helper\AbstractHelper{

    protected $_storeManager;
    protected $serializer;
    protected $deliveryTimeCollectionFactory;
    protected $_customerSession;
    protected $inlineTranslation;
    protected $transportBuilder;

    public function __construct(
       Context $context,
       StoreManagerInterface $storeManager,
       Json $serializer,
       \Magento\Customer\Model\Session $customerSession,
       CollectionFactory $deliveryTimeCollectionFactory,
       StateInterface $inlineTranslation,
       TransportBuilder $transportBuilder
   )
   {
       $this->_storeManager = $storeManager;
       $this->_customerSession = $customerSession;
       $this->serializer = $serializer;
       $this->deliveryTimeCollectionFactory = $deliveryTimeCollectionFactory;
       $this->inlineTranslation = $inlineTranslation;
       $this->transportBuilder = $transportBuilder;
       parent::__construct($context);
   }

    /**
     * @param $scope
     * @return bool
     */
   public function  canShowDelivery($scope) {

       $scopeDisplayOn = explode(',', $this->scopeConfig->getValue('delivery_time/delivery_time_config/delivery_display_on'));
       if(in_array($scope, $scopeDisplayOn))
           return true;
       return false;
   }

    /**
     * @param $deliveryTime
     * @return string
     */
    public function convertDeliveryTime($deliveryTime) {
        if(!$deliveryTime)
            return '';
        $arrTime = explode('-', $deliveryTime);
        $time = $this->convertTime($arrTime[0]).' : 00' . ' - ' . $this->convertTime($arrTime[1]).' : 00';
        return $time;
    }
    /**
     * @param $time
     * @return mixed|string
     */
    public function convertTime($time) {
        return $time < 10 ? '0'.$time : $time;
    }


    public function formatDeliveryDate() {

    }

    /**
     * @return array
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
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

    public function sendEmail($sendTo, array $vars){
        try {
            $this->inlineTranslation->suspend();
            $transport = $this->transportBuilder
                ->setTemplateIdentifier('email_reminder_delivery_time')
                ->setTemplateOptions(
                    [
                        'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                        'store' => \Magento\Store\Model\Store::DEFAULT_STORE_ID,
                    ]
                )
                ->setTemplateVars($vars)
                ->setFromByScope('general')
                ->addTo($sendTo)
                ->getTransport();
            $transport->sendMessage();
            $this->inlineTranslation->resume();
        } catch (\Exception $e) {
            $this->getLogger()->error($e->getMessage());
        }
    }
    /**
     * @return int
     */
    public function getGroupId(){

        if($this->_customerSession->isLoggedIn()){
            return $this->_customerSession->getCustomer()->getGroupId();
        }
        return \Magento\Customer\Model\Group::NOT_LOGGED_IN_ID;
    }

    /**
     * @return mixed
     */
    public function getMinimalInterval() {
        return $this->scopeConfig->getValue('delivery_time/delivery_time_config/minimal_delivery_interval', ScopeInterface::SCOPE_STORE);
    }

    /**
     * @return mixed
     */
    public function getMaximalInterval() {
        return $this->scopeConfig->getValue('delivery_time/delivery_time_config/maximal_delivery_interval', ScopeInterface::SCOPE_STORE);
    }
}