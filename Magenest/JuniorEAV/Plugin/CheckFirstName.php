<?php

namespace Magenest\JuniorEAV\Plugin;

class CheckFirstName
{

    public function afterGetData(\Magento\Catalog\Ui\DataProvider\Product\ProductDataProvider $subject, $result)
    {
        return $result;
    }
}