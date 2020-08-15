<?php


namespace Magenest\JuniorCustomCatalog\Block\Adminhtml;

use Magento\Framework\View\Element\Template;
use Magento\Sales\Model\OrderRepository;

class OrderNote extends Template
{

    /**
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    public function __construct(Template\Context $context, \Magento\Framework\Registry $registry, array $data = [])
    {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    public function getNote()
    {

       $order = $this->_coreRegistry->registry('current_order');
      return $order->getData('note');
    }
}