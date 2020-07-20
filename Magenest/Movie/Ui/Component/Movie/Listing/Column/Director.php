<?php

namespace magenest\Movie\Ui\Component\Movie\Listing\Column;


use \Magento\Framework\View\Element\UiComponent\ContextInterface;
use \Magento\Framework\View\Element\UiComponentFactory;
use \Magento\Ui\Component\Listing\Columns\Column;


class Director extends Column {

    /**
     * @var \Magenest\Movie\Model\ResourceModel\Movie\CollectionFactory
     */
    protected $collectionFactory;

    public function __construct(ContextInterface $context,
                                UiComponentFactory $uiComponentFactory,
                                \Magenest\Movie\Model\ResourceModel\Director\CollectionFactory $collectionFactory,
                                array $components = [], array $data = [])
{
    $this->collectionFactory = $collectionFactory;
    parent::__construct($context, $uiComponentFactory, $components, $data);
}

    public function prepareDataSource(array $dataSource)
    {

        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {

                $director_id = $item['director_id'];
                $collection = $this->collectionFactory->create();
                $collection->addFieldToFilter('director_id', $director_id);
                $director = $collection->getData();
                   $item['director_id'] =  $director[0]['name'];
            }
        }
        return parent::prepareDataSource($dataSource); // TODO: Change the autogenerated stub
    }
}