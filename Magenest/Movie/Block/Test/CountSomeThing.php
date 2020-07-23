<?php

namespace  Magenest\Movie\Block\Test;
use Magento\Customer\Model\ResourceModel\Customer\CollectionFactory as CustomerFactory;
use Magento\Framework\View\Element\Template;

class CountSomeThing extends  Template{

    /**
     * @var CustomerFactory
     */
    protected $_customerFactory;
    /**
     * @var \Magento\Catalog\Model\ProductFactory
     */
    protected $_productFactory;
    /**
     * @var \Magento\Sales\Model\OrderFactory
     */
    protected $_orderFactory;
    /**
     * @var \Magento\Sales\Model\Order\InvoiceFactory
     */
    protected $_invoiceFactory;
    /**
     * @var \Magento\Sales\Model\ResourceModel\Order\Creditmemo\CollectionFactory
     */
    protected $_creditmemoFactory;
    /**
     * @var \Magento\Framework\Module\FullModuleList
     */
    protected $_fullModuleList;

    public function __construct(Template\Context $context,
                            CustomerFactory $customerFactory,
                            \Magento\Catalog\Model\ProductFactory $productFactory,
                            \Magento\Sales\Model\OrderFactory $orderFactory,
                            \Magento\Sales\Model\Order\InvoiceFactory $invoiceFactory,
                            \Magento\Sales\Model\ResourceModel\Order\Creditmemo\CollectionFactory $creditmemoFactory,
                                \Magento\Framework\Module\FullModuleList $fullModuleList,
                            array $data = [])
{
    $this->_customerFactory = $customerFactory;
    $this->_productFactory = $productFactory;
    $this->_orderFactory = $orderFactory;
    $this->_invoiceFactory = $invoiceFactory;
    $this->_creditmemoFactory = $creditmemoFactory;
    $this->_fullModuleList  = $fullModuleList;
    parent::__construct($context, $data);
}

    public function getAllCustomers() {

        $customer = $this->_customerFactory->create();
        $allCustomer = $customer->getData();
        return count($allCustomer);
    }
    public function getAllProducts() {
        $collection = $this->_productFactory->create()->getCollection();

        return count($collection);
    }
    public function getAllOrders() {
        $collection = $this->_orderFactory->create()->getCollection();
        return count($collection);
    }
    public function getAllInvoices(){
        $collection = $this->_invoiceFactory->create()->getCollection();
        return count($collection);
    }
    public function getAllCreditMemo(){
        $collection = $this->_creditmemoFactory->create()->getData();
        return count($collection);
    }
    public function getFullModuleList() {
        $moduleList = $this->_fullModuleList->getAll();
        $countModule = 0;
        foreach ($moduleList as $key=>$value) {
           $firstNameModule = explode("_", $key);
           if($firstNameModule[0] != 'Magento'){
               $countModule++;
           }
        }
        return $countModule;
    }

}