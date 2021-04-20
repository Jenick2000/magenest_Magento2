<?php
namespace  Magenest\DeliveryTime\Controller\Adminhtml\DeliveryTime;

use Magenest\DeliveryTime\Controller\Adminhtml\DeliveryTime\AbstractDeliveryTime;


class Save extends AbstractDeliveryTime {


    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getParams();
        $deliveryTime = $this->deliveryTimeFactory->create();
        if(isset($data['delivery_time_id']) && !empty($data['delivery_time_id'])) {
            $deliveryTime = $deliveryTime->load($data['delivery_time_id']);
            $resultRedirect->setPath('*/*/edit', ['id' => $deliveryTime->getId()]);
        }else{
            $resultRedirect->setPath('*/*/index');
        }
        $this->saveData($deliveryTime, $data);
        $this->messageManager->addSuccessMessage('Edit delivery time successfully');
        return $resultRedirect;
    }

    /**
     * @param $deliveryTime
     * @param $data
     */
    public function saveData($deliveryTime, $data) {
        $times = $this->serializer->serialize($data['times']);
        $stores = implode('","',$data['store_id']);
        $customer_group = implode('","',$data['customer_group_id']);
        $deliveryTime->setData('store_id', '"'.$stores.'"');
        $deliveryTime->setData('times', $times);
        $deliveryTime->setData('customer_group_id', '"'.$customer_group.'"');
        $deliveryTime->save();

    }
}
