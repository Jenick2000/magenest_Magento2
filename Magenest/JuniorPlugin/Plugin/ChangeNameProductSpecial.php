<?php

namespace Magenest\JuniorPlugin\Plugin;

class ChangeNameProductSpecial
{

    public function afterGetName(\Magento\Catalog\Model\Product $subject, $result)
    {
        $product = $subject;
        $curdate = strtotime(date('Y/m/d'));
        $special_from_date = $product->getData('special_from_date');
        $special_to_date = $product->getData('special_to_date');
        if ($special_from_date && $special_to_date) {
            $special_from_date = strtotime($special_from_date);
            $special_to_date = strtotime($special_to_date);
        }

        if ($product->getData('special_price') && $curdate >= $special_from_date && $curdate <= $special_to_date) {
            return 'Special: ' . $result;
        }
        return $result;
    }

}