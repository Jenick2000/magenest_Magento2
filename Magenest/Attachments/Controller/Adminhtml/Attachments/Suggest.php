<?php

namespace Magenest\Attachments\Controller\Adminhtml\Attachments;

use Magenest\Attachments\Model\ResourceModel\Attachments\CollectionFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;

class Suggest extends Action {


    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    public function __construct(
        Context $context,
        CollectionFactory $collectionFactory
    )
    {
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $response = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $result = [];
        if($this->getRequest()->isAjax()) {
            $document = $this->getRequest()->getParam('document');
            $collection = $this->collectionFactory->create()
                ->addFieldToFilter('file_label', ['like' => $document. '%'])
                ->setPageSize(20);
            $result['items'] = $collection->getData();
            $response->setData($result);
        }

        return $response;
    }
}
