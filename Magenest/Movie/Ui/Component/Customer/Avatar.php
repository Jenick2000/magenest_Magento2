<?php

namespace magenest\Movie\Ui\Component\Customer;

use \Magento\Framework\View\Element\UiComponent\ContextInterface;
use \Magento\Framework\View\Element\UiComponentFactory;
use \Magento\Ui\Component\Listing\Columns\Column;
use Magento\Catalog\Helper\Image;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\StoreManagerInterface;

class Avatar extends Column
{


    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;
    /**
     * @var Image
     */
    protected $imageHelper;
    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    public function __construct(ContextInterface $context,
                                UiComponentFactory $uiComponentFactory,
                                Image $imageHelper,
                                UrlInterface $urlBuilder,
                                StoreManagerInterface $storeManager,
                                array $components = [], array $data = [])
    {
        $this->storeManager = $storeManager;
        $this->imageHelper = $imageHelper;
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $fieldName = $this->getData('name');
            foreach ($dataSource['data']['items'] as & $item) {
                $url = '';
                if ($item[$fieldName] != '') {
                    $url = $this->storeManager->getStore()->getBaseUrl(
                            \Magento\Framework\UrlInterface::URL_TYPE_MEDIA
                        ) . 'customer/' . $item[$fieldName];
                } else {
                    $url = 'http://127.0.0.1/magento2/pub/static/version1595296021/frontend/Magento/luma/en_US/Magento_Catalog/images/product/placeholder/small_image.jpg';
                }
                $item[$fieldName . '_src'] = $url;
                $item[$fieldName . '_alt'] = $this->getAlt($item) ?: '';
//                $item[$fieldName . '_link'] = $this->urlBuilder->getUrl(
//                    'your_module/yourentity/edit',
//                    ['yourentity_id' => $item['yourentity_id']]
//                );
                $item[$fieldName . '_orig_src'] = $url;
            }
        }

        return parent::prepareDataSource($dataSource);
    }

    /**
     * @param array $row
     *
     * @return null|string
     */
    protected function getAlt($row)
    {
        $altField = $this->getData('config/altField') ?: self::ALT_FIELD;
        return isset($row[$altField]) ? $row[$altField] : null;
    }
}