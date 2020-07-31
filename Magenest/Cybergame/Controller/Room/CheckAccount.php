<?php

namespace Magenest\Cybergame\Controller\Room;

use Magento\Framework\App\Action\Action;
use Magenest\Cybergame\Model\ResourceModel\GamerAccountList\CollectionFactory;
use Magento\Framework\App\Action\Context;

class CheckAccount extends Action
{


    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    public function __construct(Context $context, CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->getRequest()->getPost();
        $name_account = $data['account_name'];
        $accountList = $this->collectionFactory->create();
        $accountList->addFieldToFilter('account_name', $name_account);
        $result = $accountList->getData();
        if (count($result) == 0) {
            echo 0;
        } else {
            echo 1;
        }
        return;
    }
}