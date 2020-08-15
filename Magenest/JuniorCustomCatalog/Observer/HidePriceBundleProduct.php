<?php

namespace Magenest\JuniorCustomCatalog\Observer;

use Magento\Catalog\Model\Product\Pricing\Renderer\SalableResolverInterface;
use Magento\Catalog\Pricing\Price\MinimalPriceCalculatorInterface;
use Magento\Framework\Pricing\Price\PriceInterface;
use Magento\Framework\Pricing\Render\RendererPool;
use Magento\Framework\Pricing\SaleableInterface;
use Magento\Framework\View\Element\Template\Context;

class HidePriceBundleProduct extends \Magento\Bundle\Pricing\Render\FinalPriceBox
{
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    public function __construct(Context $context, \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig, SaleableInterface $saleableItem, PriceInterface $price, RendererPool $rendererPool, array $data = [], SalableResolverInterface $salableResolver = null, MinimalPriceCalculatorInterface $minimalPriceCalculator = null)
    {
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context, $saleableItem, $price, $rendererPool, $data, $salableResolver, $minimalPriceCalculator);
    }

    protected function wrapResult($html)
    {
        if ($this->checkIsEnable()) {
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $httpContext = $objectManager->get('Magento\Framework\App\Http\Context');
            $isLoggedIn = $httpContext->getValue(\Magento\Customer\Model\Context::CONTEXT_AUTH);
            if (!$isLoggedIn) {
                return '';
            }
        }
        return parent::wrapResult($html);
    }

    public function showRangePrice()
    {
        return parent::showRangePrice();
    }

    public function checkIsEnable()
    {
        $isEnable = $this->scopeConfig->getValue('price_for_guest/general/config_option', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        return $isEnable;
    }
}