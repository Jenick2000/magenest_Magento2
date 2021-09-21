<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magenest\Attachments\Ui\Component\Listing\Column;

use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;

/**
 * Class FileType
 *
 * @api
 * @since 100.0.2
 */
class FileType extends Column
{

    /**
     * @var Json
     */
    private Json $serialize;

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param Json $serialize
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        Json $serialize,
        array $components = [],
        array $data = []
    ) {
        $this->serialize = $serialize;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $file = $this->serialize->unserialize($item['path']);
                $item[$this->getData('name')] = $file[0]['type'];
                $item['file_size'] = $this->formatSize($file[0]['size']);
            }
        }

        return $dataSource;
    }

    /**
     * return size with format type
     * @param $size
     * @return string
     */
    public function formatSize($size) {
        $sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
        if (!$size) {
            return '0 Byte';
        }
        $i = intval(floor(log($size) / log(1024)));
        $result = round($size / pow(1024, $i), 2);

        return $result . ' ' . $sizes[$i] ;
    }
}
