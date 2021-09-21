<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magenest\Attachments\Model\Product\Attribute\Backend;


use Magenest\Attachments\Model\ResourceModel\AttachmentRepository;

/**
 * Class Document
 * @package Magenest\Attachments\Model\Product\Attribute\Backend
 */
class Document extends \Magento\Eav\Model\Entity\Attribute\Backend\AbstractBackend
{
    /**
     * @var AttachmentRepository
     */
    private $attacmentrepository;

    public function __construct(AttachmentRepository $attachmentRepository)
    {
        $this->attacmentrepository = $attachmentRepository;
    }

    public function afterLoad($object)
    {
        $attributeCode = $this->getAttribute()->getName();
        $attachmentId = $object->getData($attributeCode);
        if($attachmentId) {
            try {
                $attachment = $this->attacmentrepository->getById($attachmentId);
                $object->setData($attributeCode, $attachment->getFileLabel());
            }catch (\Exception $e) {
                // do something
            }
        }
        return parent::afterLoad($object);
    }
}
