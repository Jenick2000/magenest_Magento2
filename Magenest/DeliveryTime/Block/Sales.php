<?php
namespace Magenest\DeliveryTime\Block;

use Magento\Framework\View\Element\Template;
use Magento\Catalog\Model\Rss\Product\Special;
use Magenest\DeliveryTime\Helper\Delivery;
use Magento\Customer\Model\Session as CustomerSession;

class Sales extends \Magento\Framework\View\Element\Template {

    protected $specialCollection;
    protected $deliveryHelper;
    protected $customerSession;
    /**
     * @var int
     */
    protected $_displayPages = 12;

    public function __construct(
        Template\Context $context,
        Special $specialCollection,
        Delivery $deliveryHelper,
        CustomerSession $customerSession,
        array $data = []
    ){
        $this->specialCollection  = $specialCollection;
        $this->deliveryHelper     = $deliveryHelper;
        $this->customerSession   = $customerSession;
        parent::__construct($context, $data);
    }

    /**
     * @return \Magento\Catalog\Model\ResourceModel\Product\Collection
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getProductsCollection() {
        $storeId = $this->_storeManager->getStore()->getId();
        $customerGroupId = $this->customerSession->getCustomer()->getGroupId();
        return $this->specialCollection->getProductsCollection($storeId, $customerGroupId);
    }

    public function getProductUrl($product) {
        return $this->_storeManager->getStore()->getUrl('sale/'.$product->getSku());
    }

    /**
     * Get pages
     *
     * @return array
     */
    public function getPages()
    {
        $collection = $this->getProductsCollection()->setPageSize(12);

        if ($collection->getLastPageNumber() <= $this->_displayPages) {
            return range(1, $collection->getLastPageNumber());
        } else {
            $half = ceil($this->_displayPages / 2);
            if ($collection->getCurPage() >= $half &&
                $collection->getCurPage() <= $collection->getLastPageNumber() - $half
            ) {
                $start = $collection->getCurPage() - $half + 1;
                $finish = $start + $this->_displayPages - 1;
            } elseif ($collection->getCurPage() < $half) {
                $start = 1;
                $finish = $this->_displayPages;
            } elseif ($collection->getCurPage() > $collection->getLastPageNumber() - $half) {
                $finish = $collection->getLastPageNumber();
                $start = $finish - $this->_displayPages + 1;
            }
            return range($start, $finish);
        }
    }

}