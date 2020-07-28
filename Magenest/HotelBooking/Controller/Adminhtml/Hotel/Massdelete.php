<?php


namespace Magenest\HotelBooking\Controller\Adminhtml\Hotel;

use Magento\Backend\App\Action;
use Magenest\HotelBooking\Model\ResourceModel\Hotel\CollectionFactory;
use Magento\Ui\Component\MassAction\Filter;

class Massdelete extends Action
{


    protected $filter;
    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    public function __construct(Action\Context $context, Filter $filter, CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
        $this->filter = $filter;

        parent::__construct($context);
    }

    /**
     * Dispatch request
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $collectionSize = $collection->getSize();

        foreach ($collection as $item) {
            $item->delete();
        }

        $this->messageManager->addSuccessMessage(__('A total of %1 element(s) have been deleted.', $collectionSize));

        $this->_redirect('*/*/index');
    }
}