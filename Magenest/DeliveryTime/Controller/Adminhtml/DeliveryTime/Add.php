<?php
namespace Magenest\DeliveryTime\Controller\Adminhtml\DeliveryTime;

class Add extends AbstractDeliveryTime {
    /**
     * @inheritDoc
     */
    public function execute()
    {
        $resultForward = $this->resultForwardFactory->create();
        $resultForward->forward('edit');
        return $resultForward;
    }
}
