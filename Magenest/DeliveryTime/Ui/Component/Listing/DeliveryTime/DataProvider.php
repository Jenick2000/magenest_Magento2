<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magenest\DeliveryTime\Ui\Component\Listing\DeliveryTime;

use Magenest\DeliveryTime\Model\ResourceModel\DeliveryTime\CollectionFactory;
use Magento\Framework\Api\Filter;

/**
 * Custom DataProvider for message listing
 */
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var \Magento\Framework\App\RequestInterface $request,
     */
    private $request;


    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param \Magento\Framework\App\RequestInterface $request
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        \Magento\Framework\App\RequestInterface $request,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
        $this->request = $request;
    }

    /**
     *
     * @return array
     */
    public function getData(): array
    {
        $collection = $this->getCollection();
        return $collection->toArray();

    }

    /**
     * Add full text search filter to collection
     *
     * @param Filter $filter
     * @return void
     */
    public function addFilter(Filter $filter): void
    {

        $this->collection->addFieldToFilter(
            $filter->getField(),
            [$filter->getConditionType() => $filter->getValue()]
        );

    }
}
