<?php

namespace Magenest\Movie\Block;

use Magento\Framework\View\Element\Template;

class Clock extends Template
{

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    public function __construct(Template\Context $context, \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig, array $data = [])
    {
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context, $data);
    }

    public function getConfigBackgroundColor()
    {
        $color = $this->scopeConfig->getValue('clock/clockConfig/color_clock', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        return $color;
    }

    public function getConfigTitleColor()
    {
        $color = $this->scopeConfig->getValue('clock/clockConfig/text_color_clock', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        return $color;
    }

    public function getConfigSizeClock()
    {
        return $this->scopeConfig->getValue('clock/clockConfig/size_clock', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

}