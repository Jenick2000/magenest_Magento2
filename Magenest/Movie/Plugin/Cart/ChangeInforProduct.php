<?php

namespace Magenest\Movie\Plugin\Cart;

use Magento\Catalog\Model\Product;

class ChangeInforProduct
{


    public function aroundGetItemData($subject, $proceed, $item)
    {

        $result = $proceed($item);

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $product = $objectManager->create('Magento\Catalog\Model\Product')->load($result['product_id']);

        /* thum url */
        $storeManager = $objectManager->create('Magento\Store\Model\StoreManagerInterface');
        $currentStore = $storeManager->getStore();
        $mediaUrl = $currentStore->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
//        get data of option product
        $chirenProduct = $item->getChildren();
        if (count($chirenProduct) != 0) {
            $childrenData = $chirenProduct[0]->getData();
            $urlImage = $childrenData["product"]->getData()['small_image'];
            $mediaUrl .= 'catalog/product/cache/43a988f082e773a0ab0e0d38532218ef' . $urlImage;

            if ($product->getThumbnail()) {
                $result['product_image']['src'] = $mediaUrl;
            }
            $result['product_name'] = $childrenData['name'];
        }
        return $result;
    }
}