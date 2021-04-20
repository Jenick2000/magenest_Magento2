<?php
namespace Magenest\DeliveryTime\Controller\Adminhtml\DeliveryTime;

class Index extends AbstractDeliveryTime {
    /**
     * @inheritDoc
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Magenest_DeliveryTime::time');
        $resultPage->getConfig()->getTitle()->prepend(__('Delivery Times'));

        return $resultPage;
    }
}
