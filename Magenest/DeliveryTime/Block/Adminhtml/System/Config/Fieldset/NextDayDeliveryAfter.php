<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magenest\DeliveryTime\Block\Adminhtml\System\Config\Fieldset;

use Magento\Backend\Block\Template\Context;
use Magento\Framework\Data\Form\Element\AbstractElement;
use \Magento\Store\Model\ScopeInterface;
use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\View\Helper\SecureHtmlRenderer;

/**
 * Class Hint adds "Configuration Details" link to payment configuration.
 * `<comment>` node must be defined in `<group>` node and contain some link.
 */
class NextDayDeliveryAfter extends Field
{
    const XML_PATH_HOUR_NEXT_DAY_DELIVERY_AFTER = 'delivery_time/delivery_time_config/hour_next_day_delivery_after';
    const XML_PATH_MINUTE_NEXT_DAY_DELIVERY_AFTER = 'delivery_time/delivery_time_config/minute_next_day_delivery_after';
    /**
     * @var string
     * @deprecated 100.1.0
     */
    protected $_template = 'Magenest_DeliveryTime::system/config/fieldset/nextDayDeliveryAfter.phtml';
    protected $scopeConfig;


    /**
     * NextDayDeliveryAfter constructor.
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param Context $context
     * @param array $data
     * @param SecureHtmlRenderer|null $secureRenderer
     */
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        Context $context,
        array $data = [],
        ?SecureHtmlRenderer $secureRenderer = null
    ){
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context, $data, $secureRenderer);
    }

    /**
     * @param AbstractElement $element
     * @return string
     */
    public function render(\Magento\Framework\Data\Form\Element\AbstractElement $element)
   {
       return parent::render($element);
   }

    protected function _getElementHtml(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        return $this->toHtml();
    }

    public function getTimeOptions($limit, $step) {
       $options = [];
       for($h = 0; $h <= $limit;) {
            $options[] = ['value' => $h, 'label' => $h < 10 ? '0'.$h : $h];
            $h += $step;
       }
       return $options;
    }

    public function getConfigData() {

        $hourConfig   = $this->scopeConfig->getValue(self::XML_PATH_HOUR_NEXT_DAY_DELIVERY_AFTER, ScopeInterface::SCOPE_STORE);
        $minuteConfig = $this->scopeConfig->getValue(self::XML_PATH_MINUTE_NEXT_DAY_DELIVERY_AFTER, ScopeInterface::SCOPE_STORE);

        return ['hourConfig' => $hourConfig, 'minuteConfig' => $minuteConfig];
    }
}
