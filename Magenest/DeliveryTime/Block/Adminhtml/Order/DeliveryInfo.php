<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magenest\DeliveryTime\Block\Adminhtml\Order;

use Magento\Shipping\Helper\Data as ShippingHelper;
use Magento\Tax\Helper\Data as TaxHelper;

/**
 * Order history block
 *
 * @api
 * @since 100.0.2
 */
class DeliveryInfo extends \Magento\Sales\Block\Adminhtml\Order\AbstractOrder
{
    /**
     * @var \Magenest\DeliveryTime\Helper\Delivery
     */
    protected  $deliveryHelper;

    /**
     * DeliveryInfo constructor.
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Sales\Helper\Admin $adminHelper
     * @param \Magenest\DeliveryTime\Helper\Delivery $deliveryHelper
     * @param array $data
     * @param ShippingHelper|null $shippingHelper
     * @param TaxHelper|null $taxHelper
     */
    public function __construct(
     \Magento\Backend\Block\Template\Context $context,
     \Magento\Framework\Registry $registry,
     \Magento\Sales\Helper\Admin $adminHelper,
     \Magenest\DeliveryTime\Helper\Delivery $deliveryHelper,
     array $data = [],
     ?ShippingHelper $shippingHelper = null,
     ?TaxHelper $taxHelper = null
 ){
        $this->deliveryHelper = $deliveryHelper;
     parent::__construct($context, $registry, $adminHelper, $data, $shippingHelper, $taxHelper);
 }


    /**
     * @return mixed|null
     */
    public function getInvoice()
    {
        return $this->_coreRegistry->registry('current_invoice');
    }

    /**
     * Retrieve shipment model instance
     *
     * @return \Magento\Sales\Model\Order\Shipment
     */
    public function getShipment()
    {
        return $this->_coreRegistry->registry('current_shipment');
    }
    /**
     * @param $time
     * @return string
     */
    public function convertDeliveryTime($time) {
       return $this->deliveryHelper->convertDeliveryTime($time);
    }

    public function canShowDelivery($scope) {
        return $this->deliveryHelper->canShowDelivery($scope);
    }

}
