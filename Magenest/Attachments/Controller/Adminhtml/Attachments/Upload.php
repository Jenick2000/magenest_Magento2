<?php
namespace Magenest\Attachments\Controller\Adminhtml\Attachments;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magenest\Attachments\Model\FileUploader;
use Magento\Framework\Controller\ResultFactory;

class Upload extends Action {


    /**
     * @var FileUploader
     */
    private $fileUploader;

    /**
     * Upload constructor.
     * @param Context $context
     * @param FileUploader $fileUploader
     */
    public function __construct(
        Context $context,
        FileUploader $fileUploader
    )
    {
        parent::__construct($context);
        $this->fileUploader = $fileUploader;
    }

    /**
     * Upload file controller action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        try {
            $result = $this->fileUploader->saveFileToTmpDir('path');
        } catch (\Exception $e) {
            $result = ['error' => $e->getMessage(), 'errorcode' => $e->getCode()];
        }
        return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($result);
    }
}
