<?php

namespace Magenest\DeliveryTime\Plugin;

use Magento\Checkout\Api\Data\ShippingInformationInterface;
use Magento\Checkout\Api\ShippingInformationManagementInterface;

/**
 * Class ShippingInformationManagement
 * @package Magenest\Directory\Model\Plugin
 */
class ShippingInformationManagement
{

    /**
     * @param ShippingInformationManagementInterface $subject
     * @param $cartId
     * @param ShippingInformationInterface $addressInformation
     * @return array
     */
    public function beforeSaveAddressInformation(
        ShippingInformationManagementInterface $subject,
        $cartId,
        ShippingInformationInterface $addressInformation
    ) {
        $return = [$cartId, $addressInformation];
        $shippingAddress = $addressInformation->getShippingAddress();
        $shippingAddress->setDeliveryDate($addressInformation->getExtensionAttributes()->getDeliveryDate());
        $shippingAddress->setDeliveryTime($addressInformation->getExtensionAttributes()->getDeliveryTime());
        $shippingAddress->setDeliveryComment($addressInformation->getExtensionAttributes()->getDeliveryComment());
        return $return;
    }
}
