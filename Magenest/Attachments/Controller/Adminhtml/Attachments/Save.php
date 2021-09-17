<?php
namespace Magenest\Attachments\Controller\Adminhtml\Attachments;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Exception\NoSuchEntityException;
use Magenest\Attachments\Model\ResourceModel\AttachmentRepository;
use Magenest\Attachments\Model\AttachmentsFactory;
use Magento\Framework\Serialize\Serializer\Json;

class Save extends Action {

    /**
     * @var AttachmentRepository
     */
    protected $attachmentRepository;

    /**
     * @var AttachmentsFactory
     */
    protected $attachmentFactory;

    /**
     * @var Json
     */
    protected  $serialize;

    public function __construct(
        Context $context,
        AttachmentRepository $attachmentRepository,
        AttachmentsFactory $attachmentsFactory,
        Json $serialize
    )
    {
        $this->attachmentRepository = $attachmentRepository;
        $this->attachmentFactory = $attachmentsFactory;
        $this->serialize = $serialize;
        parent::__construct($context);
    }

    public function execute()
    {
        $returnToEdit = false;

        if($this->getRequest()->getPostValue()) {
            try {
                $data = $this->getRequest()->getParams();
                if(!empty($data['file_id'])){
                    $attachment = $this->attachmentRepository->getById((int)$data['file_id']);
                }else{
                    $attachment = $this->attachmentFactory->create();
                    unset($data['file_id']);
                }
                if($data['customer_group_ids']) {
                    $data['customer_group_ids'] = implode(',', $data['customer_group_ids']);
                }
                $attachment->setData($data);
                $this->attachmentRepository->save($attachment);
                $this->messageManager->addSuccessMessage(__('Attachment was successfully saved'));
                $returnToEdit = (bool)$this->getRequest()->getParam('back', false);
            }catch (NoSuchEntityException $exception) {
                $this->messageManager->addExceptionMessage(
                    $exception,
                    __('Something went wrong while saving the customer.')
                );
                $returnToEdit = false;
            }catch (\Exception $exception) {
                $this->messageManager->addExceptionMessage($exception, $exception->getMessage());
                $returnToEdit = true;
            }
        }

        $resultRedirect = $this->resultRedirectFactory->create();
        if ($returnToEdit) {
            if ($attachment->getId()) {
                $resultRedirect->setPath(
                    'magenest/attachments/edit',
                    ['id' => $attachment->getId(), '_current' => true]
                );
            } else {
                $resultRedirect->setPath(
                    'magenest/attachments/new',
                    ['_current' => true]
                );
            }
        } else {
            $resultRedirect->setPath('magenest/attachments/index');
        }
        return $resultRedirect;
    }
}
