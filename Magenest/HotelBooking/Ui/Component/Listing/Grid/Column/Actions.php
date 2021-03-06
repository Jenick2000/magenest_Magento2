<?php

namespace Magenest\HotelBooking\Ui\Component\Listing\Grid\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;

class Actions extends Column
{

    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    public function __construct(ContextInterface $context, UiComponentFactory $uiComponentFactory, UrlInterface $url, array $components = [], array $data = [])
    {
        $this->urlBuilder = $url;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                // here we can also use the data from $item to configure some parameters of an action URL
                $item[$this->getData('name')] = [
                    'edit' => [
                        'href' => $this->urlBuilder->getUrl('magenest/hotel/edit', ['id' => $item['hotel_id']]),
                        'label' => __('Edit')
                    ],
                    'delete' => [
                        'href' => $this->urlBuilder->getUrl('magenest/hotel/delete', ['id' => $item['hotel_id']]),
                        'label' => __('Delete')
                    ]
                ];
            }
        }
        return parent::prepareDataSource($dataSource); // TODO: Change the autogenerated stub
    }
}