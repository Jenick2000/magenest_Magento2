<?php

namespace Magenest\DeliveryTime\Block\Order;


/**
 * Sales order view block
 *
 * @api
 * @since 100.0.2
 */
class DeliveryInfo extends \Magento\Framework\View\Element\Template
{

    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    /**
     * @var \Magento\Framework\App\Http\Context
     * @since 101.0.0
     */
    protected $httpContext;
    protected $deliveryHelper;
    private $test;


    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\App\Http\Context $httpContext
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\App\Http\Context $httpContext,
        \Magenest\DeliveryTime\Helper\Delivery $deliveryHelper,
        \Magenest\DeliveryTime\Cron\DeliveryReminder $test,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        $this->httpContext = $httpContext;
        $this->deliveryHelper = $deliveryHelper;
        $this->test = $test;
        parent::__construct($context, $data);
        $this->_isScopePrivate = true;
    }



    /**
     * Retrieve current order model instance
     *
     * @return \Magento\Sales\Model\Order
     */
    public function getOrder()
    {
        return $this->_coreRegistry->registry('current_order');
    }

    /**
     * @return bool
     */
    public function canShow() {
        return $this->deliveryHelper->canShowDelivery('order_info_frontend');
    }

    public function convertDeliveryTime($time) {
        return $this->deliveryHelper->convertDeliveryTime($time);
    }

    public function test() {
        $this->test->execute();
    }
}
