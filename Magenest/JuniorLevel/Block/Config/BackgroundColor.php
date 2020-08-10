<?php

namespace Magenest\JuniorLevel\Block\Config;

use Magento\Framework\View\Element\Template;

class BackgroundColor extends Template
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

    public function getBackgroundColor()
    {

        $colorOption = $this->scopeConfig->getValue('background/config_color/color_option', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        return json_decode($colorOption, true);
    }
}