<?php

namespace Magenest\Cybergame\Block\RoomOption;

use Magento\Framework\View\Element\Template;

//use Magenest\Cybergame\Model\ResourceModel\RoomExtraOption\CollectionFactory as RoomOPtionCollection;
//use Magenest\Cybergame\Model\ResourceModel\GamerAccountList\CollectionFactory as GamerAccoutListCollection;

//use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as ProductCollectionFactory;

class ListRoom extends Template
{

    /**
     * @var \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory
     */
    protected $_productCollectionFactory;
    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $customerSession;

    public function __construct(Template\Context $context,
                                \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
                                \Magento\Customer\Model\Session $customerSession,
                                array $data = [])
    {
        $this->_productCollectionFactory = $productCollectionFactory;
        $this->customerSession = $customerSession;
        parent::__construct($context, $data);
    }

    public function checkIsManager()
    {
        $customer = $this->customerSession->getCustomer()->getData();
        if (array_key_exists('is_manager', $customer)) {
            if ($customer['is_manager'] == 1) {
                return true;
            }
        }
        return false;
    }

    public function getProductCollection()
    {
        $productCollection = $this->_productCollectionFactory->create()
            ->addAttributeToSelect(['name', 'price', 'image'])
            ->addAttributeToFilter('entity_id', array('gteq' => 31));
        return $productCollection;
    }
}
