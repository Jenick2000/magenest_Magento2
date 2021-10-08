<?php
namespace Magenest\Attachments\CustomerData;

use Magenest\Attachments\Model\Product\Type\Course;
use Magenest\Attachments\Model\ResourceModel\AttachmentRepository;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\Product\Configuration\Item\ItemResolverInterface;
use Magento\Framework\App\ObjectManager;

class DefaultItem extends \Magento\Checkout\CustomerData\DefaultItem {

    /**
     * @var \Magento\Framework\Escaper|mixed|null
     */
    protected $_escaper;

    /**
     * @var AttachmentRepository
     */
    protected $attacmentrepository;


    public function __construct(
        \Magento\Catalog\Helper\Image $imageHelper,
        \Magento\Msrp\Helper\Data $msrpHelper,
        \Magento\Framework\UrlInterface $urlBuilder,
        \Magento\Catalog\Helper\Product\ConfigurationPool $configurationPool,
        \Magento\Checkout\Helper\Data $checkoutHelper,
        AttachmentRepository $attachmentRepository,
        \Magento\Framework\Escaper $escaper = null,
        ItemResolverInterface $itemResolver = null)
    {
        $this->attacmentrepository = $attachmentRepository;
        $this->_escaper = $escaper ?: ObjectManager::getInstance()->get(\Magento\Framework\Escaper::class);
        parent::__construct($imageHelper, $msrpHelper, $urlBuilder, $configurationPool, $checkoutHelper, $escaper, $itemResolver);
    }

    protected function doGetItemData()
    {
        $imageHelper = $this->imageHelper->init($this->getProductForThumbnail(), 'mini_cart_product_thumbnail');
        $productName = $this->_escaper->escapeHtml($this->item->getProduct()->getName());

        $attach = [];
        if($this->item->getProductType() == Course::TYPE_CODE){
            $attachment = $this->getAttachment($this->item->getProduct()->getDocument());
            if($attachment->getData() && $attachment->getVisible()) {
                $attach = [
                    'label' => $attachment->getFileLabel() ?? '',
                    'url'   => $attachment->getPath()[0]['url'],
                ];
            }
        }
        return [
            'options' => $this->getOptionList(),
            'qty' => $this->item->getQty() * 1,
            'item_id' => $this->item->getId(),
            'configure_url' => $this->getConfigureUrl(),
            'is_visible_in_site_visibility' => $this->item->getProduct()->isVisibleInSiteVisibility(),
            'product_id' => $this->item->getProduct()->getId(),
            'product_name' => $productName,
            'product_sku' => $this->item->getProduct()->getSku(),
            'product_url' => $this->getProductUrl(),
            'product_has_url' => $this->hasProductUrl(),
            'product_price' => $this->checkoutHelper->formatPrice($this->item->getCalculationPrice()),
            'product_price_value' => $this->item->getCalculationPrice(),
            'product_image' => [
                'src' => $imageHelper->getUrl(),
                'alt' => $imageHelper->getLabel(),
                'width' => $imageHelper->getWidth(),
                'height' => $imageHelper->getHeight(),
            ],
            'canApplyMsrp' => $this->msrpHelper->isShowBeforeOrderConfirm($this->item->getProduct())
                && $this->msrpHelper->isMinimalPriceLessMsrp($this->item->getProduct()),
            'message' => $this->item->getMessage(),
            'attachment' => $attach
        ];
    }

    /**
     * @param $documentId
     * @return array|\Magenest\Attachments\Model\Attachments|mixed
     */
    public function getAttachment($documentId) {
        try{
            if($documentId){
                return $this->attacmentrepository->getById($documentId);
            }
        }catch (\Exception $e) {
            return [];
        }
        return [];
    }
}
