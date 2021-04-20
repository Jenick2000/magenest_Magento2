<?php
namespace Magenest\DeliveryTime\Controller\Ajax;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\View\Result\PageFactory;

class Sale extends Action {

    private $_resultPageFactory;
    private $_resultJsonFactory;

    public function __construct(Context $context, PageFactory $resultPageFactory, JsonFactory $resultJsonFactory)
    {
        $this->_resultPageFactory = $resultPageFactory;
        $this->_resultJsonFactory = $resultJsonFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $result = $this->_resultJsonFactory->create();
        $resultPage = $this->_resultPageFactory->create();
        $param = $this->_request->getParams();

        $block = $resultPage->getLayout()
            ->createBlock('Magenest\DeliveryTime\Block\Sales')
            ->setTemplate('Magenest_DeliveryTime::render-sale-products.phtml')
            ->setData('data', $param)
            ->toHtml();

        $result->setData(['output' => $block, 'page' => $param['page']]);
        return $result;

    }
}