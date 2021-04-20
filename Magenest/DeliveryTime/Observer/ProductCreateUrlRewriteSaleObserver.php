<?php
namespace Magenest\DeliveryTime\Observer;

use Magento\Catalog\Model\Product;
use Magento\Framework\Event\ObserverInterface;

class ProductCreateUrlRewriteSaleObserver implements ObserverInterface
{
    const ENTITY_TYPE_PRODUCT = 'product';
    protected $urlRewrite;
    protected $urlRewriteCollectionFactory;
    protected $storeManager;


    /**
     * @param \Magento\Framework\DataObject\Copy $objectCopyService
     * ...
     */
    public function __construct(
        \Magento\UrlRewrite\Model\UrlRewriteFactory $urlRewriteFactory,
        \Magento\UrlRewrite\Model\ResourceModel\UrlRewriteCollectionFactory $urlRewriteCollectionFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        $this->urlRewrite = $urlRewriteFactory;
        $this->urlRewriteCollectionFactory = $urlRewriteCollectionFactory;
        $this->storeManager = $storeManager;
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        /** @var Product $product */
        $product = $observer->getEvent()->getProduct();
        $requestPath = 'sale/' . $product->getSku();
        $targetPath = 'catalog/product/view/id/' . $product->getId();

        $urlRewrite = $this->urlRewriteCollectionFactory->create()
            ->addFieldToFilter('request_path', $requestPath)
            ->getFirstItem();

        if($product->getSpecialPrice() < $product->getPrice() && !$urlRewrite->getId()) {
            $model = $this->urlRewrite->create();
            $storeManagerDataList = $this->storeManager->getStores();
            foreach ($storeManagerDataList as $store) {
                $model->unsetData();
                $model->setEntityType(self::ENTITY_TYPE_PRODUCT)
                ->setRequestPath($requestPath)
                ->setEntityId($product->getId())
                ->setTargetPath($targetPath)
                ->setRedirectType(0)
                ->setStoreId($store->getId())
                ->setDescription('create url /sale/sku when product have sale')
                ->save();
            }
        }


    }
}
