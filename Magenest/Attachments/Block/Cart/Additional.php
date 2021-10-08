<?php

namespace Magenest\Attachments\Block\Cart;

use Magenest\Attachments\Model\ResourceModel\AttachmentRepository;
use Magento\Framework\View\Element\Template;

class Additional extends Template {

    /**
     * @var AttachmentRepository
     */
    private $attacmentrepository;


    public function __construct(
        Template\Context $context,
        AttachmentRepository $attachmentRepository,
        array $data = [])
    {
        $this->attacmentrepository = $attachmentRepository;
        parent::__construct($context, $data);
    }

    /**
     * @param $attachId
     * @return array|\Magenest\Attachments\Model\Attachments|mixed
     */
    public function getInfoAttachment($attachId) {
        try {
            return $this->attacmentrepository->getById($attachId);
        }catch (\Exception  $e) {}
        return [];
    }

}
