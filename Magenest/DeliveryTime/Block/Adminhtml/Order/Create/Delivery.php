<?php
namespace Magenest\DeliveryTime\Block\Adminhtml\Order\Create;


use Magento\Backend\Block\Template;
use Magento\Directory\Helper\Data as DirectoryHelper;
use Magento\Framework\Json\Helper\Data as JsonHelper;
use Magenest\DeliveryTime\Helper\Delivery as DeliveryHelper;
use Magento\Backend\Model\Session\Quote;
class Delivery extends Template {

    protected $deliveryHelper;
    protected $sessionQuote;

    public function __construct(
        Template\Context $context,
        DeliveryHelper $deliveryHelper,
        Quote $sessionQuote,
        array $data = [],
        ?JsonHelper $jsonHelper = null,
        ?DirectoryHelper $directoryHelper = null
    ){
        $this->deliveryHelper = $deliveryHelper;
        $this->sessionQuote = $sessionQuote;
        parent::__construct($context, $data, $jsonHelper, $directoryHelper);
    }

    /**
     * @return array
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getDeliveryTime() {
        return $this->deliveryHelper->getDeliveryTimes();
    }

    /**
     * @return mixed
     */
    public function getMinimalInterval() {
        return $this->deliveryHelper->getMinimalInterval();
    }

    /**
     * @return mixed
     */
    public function getMaximalInterval() {
        return $this->deliveryHelper->getMaximalInterval();
    }

    /**
     * @return \Magento\Quote\Model\Quote
     */
    public function getQuote() {

        return $this->sessionQuote->getQuote();
    }
}