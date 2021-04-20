<?php
namespace Magenest\DeliveryTime\Observer;

use Magento\Framework\Event\ObserverInterface;

class SaveOrderBeforeSalesModelQuoteObserver implements ObserverInterface
{

    /**
     * @var \Magento\Framework\DataObject\Copy
     */
    protected $objectCopyService;


    /**
     * @param \Magento\Framework\DataObject\Copy $objectCopyService
     * ...
     */
    public function __construct(
        \Magento\Framework\DataObject\Copy $objectCopyService
    ) {
        $this->objectCopyService = $objectCopyService;
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        /* @var \Magento\Sales\Model\Order $order */
        $order = $observer->getEvent()->getData('order');
        /* @var \Magento\Quote\Model\Quote $quote */
        $quote = $observer->getEvent()->getData('quote');

        $quote->setDeliveryDate($quote->getShippingAddress()->getDeliveryDate());
        $quote->setDeliveryTime($quote->getShippingAddress()->getDeliveryTime());
        $quote->setDeliveryComment($quote->getShippingAddress()->getDeliveryComment());
        $this->objectCopyService->copyFieldsetToTarget('quote_convert_to_order', 'to_order', $quote, $order);

        return $this;
    }
}
