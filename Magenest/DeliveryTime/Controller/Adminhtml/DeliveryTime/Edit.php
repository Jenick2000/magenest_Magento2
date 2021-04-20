<?php
namespace Magenest\DeliveryTime\Controller\Adminhtml\DeliveryTime;

use Magento\Framework\Exception\NoSuchEntityException;

class Edit extends AbstractDeliveryTime
{
    /**
     * Initialize current author and set it in the registry.
     *
     * @return int
     */
    protected function _initAuthor()
    {
        return $this->getRequest()->getParam('id');
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Page|\Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Exception
     */
    public function execute()
    {
        $deliveryTimeId = $this->_initAuthor();
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $redirectPage = $this->resultRedirectFactory->create();
        if ($deliveryTimeId === null) {
            $resultPage->addBreadcrumb(__('New Button'), __('New Delivery Time'));
            $resultPage->getConfig()->getTitle()->prepend(__('New Delivery Time'));
        } else {
            $resultPage->addBreadcrumb(__('Edit Delivery Time'), __('Edit Delivery Time'));
            try {
                $resultPage->getConfig()->getTitle()->prepend('Edit Delivery Time');
            }catch (NoSuchEntityException $eNoSuchEntity){
                $redirectPage->setPath('*/*/index');
                $this->messageManager->addErrorMessage(__("The delivery time that was requested doesn't exist. Verify the message and try again."));
                return $redirectPage;
            }catch (\Exception $e){
                $redirectPage->setPath('*/*/index');
                $this->messageManager->addExceptionMessage($e, $e->getMessage());
                return $redirectPage;
            }
        }
        return $resultPage;
    }
}
