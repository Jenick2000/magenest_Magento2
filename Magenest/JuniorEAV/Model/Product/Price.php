<?php

namespace Magenest\JuniorEAV\Model\Product;

use Magento\Framework\Pricing\PriceCurrencyInterface;

class Price extends \Magento\Catalog\Model\Product\Type\Price
{
    /**
     * @return PriceCurrencyInterface
     */
    public function getPriceCurrency(): PriceCurrencyInterface
    {
        return $this->priceCurrency;
    }
}