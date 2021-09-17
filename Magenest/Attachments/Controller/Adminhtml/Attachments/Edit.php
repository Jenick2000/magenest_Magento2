<?php

namespace Magenest\Attachments\Controller\Adminhtml\Attachments;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Magenest\Attachments\Api\AttachmentRepositoryInterface;

class Edit extends Action {

    /**
     * @var AttachmentRepositoryInterface
     */
    protected $attachmentRepository;

    public function __construct(
        Context $context,
        AttachmentRepositoryInterface $attachmentRepository
    )
    {
        $this->attachmentRepository = $attachmentRepository;
        parent::__construct($context);
    }

    public function execute()
    {
        $fileId = $this->getRequest()->getParam('id');
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $redirectPage = $this->resultRedirectFactory->create();
        if ($fileId === null) {
            $resultPage->getConfig()->getTitle()->prepend(__('New Attachment'));
        } else {
            $resultPage->addBreadcrumb(__('Edit Attachment'), __('Edit Attachment'));
            try {
                $resultPage->getConfig()->getTitle()->prepend(
                    $this->attachmentRepository->getById($fileId)->getFileName()
                );
                $resultPage->setActiveMenu('Magenest_Attachments::attachments');
            }catch (NoSuchEntityException $eNoSuchEntity){
                $redirectPage->setPath('*/*/index');
                $this->messageManager->addErrorMessage(__("The attachment that was requested doesn't exist. Verify the attachment and try again."));
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
