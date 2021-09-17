<?php
namespace Magenest\Attachments\Model\ResourceModel;

use Magenest\Attachments\Api\AttachmentRepositoryInterface;
use Magenest\Attachments\Api\Data\AttachmentInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magenest\Attachments\Model\Attachments;

class AttachmentRepository implements AttachmentRepositoryInterface {

    /**
     * @var \Magenest\Attachments\Model\AttachmentsFactory
     */
    protected $attachmentsFactory;

    protected $attachmentRegistryById = [];

    /**
     * @var \Magenest\Attachments\Model\ResourceModel\Attachments
     */
    protected $attachmentsResource;

    public function __construct(
        \Magenest\Attachments\Model\AttachmentsFactory $attachmentsFactory,
        \Magenest\Attachments\Model\ResourceModel\Attachments $attachmentsResource
    )
    {
        $this->attachmentsResource = $attachmentsResource;
        $this->attachmentsFactory = $attachmentsFactory;
    }

    public function getById($id)
    {
        if (isset($this->attachmentRegistryById[$id])) {
            return $this->attachmentRegistryById[$id];
        }
        /** @var Attachments $attachment */
        $attachment = $this->attachmentsFactory->create()->load($id);
        if (!$attachment->getId()) {
            // attachment does not exist
            throw NoSuchEntityException::singleField('AttachmentId', $id);
        } else {
            $this->attachmentRegistryById[$id] = $attachment;
            return $attachment;
        }
    }

    /**
     * @param AttachmentInterface $attachment
     * @return \Magenest\Attachments\Model\ResourceModel\Attachments|mixed
     * @throws \Magento\Framework\Exception\AlreadyExistsException
     */
    public function save(AttachmentInterface $attachment)
    {
        return $this->attachmentsResource->save($attachment);
    }

    public function deleteById($id)
    {
        // TODO: Implement deleteById() method.
    }
}
