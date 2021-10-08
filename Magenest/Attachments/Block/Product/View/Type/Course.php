<?php
namespace Magenest\Attachments\Block\Product\View\Type;

use Magenest\Attachments\Model\ResourceModel\AttachmentRepository;
use Magento\Catalog\Model\Product;
use Magento\Framework\Serialize\Serializer\Json;

class Course extends \Magento\Catalog\Block\Product\View\AbstractView {

    /**
     * @var AttachmentRepository
     */
    protected $attacmentrepository;

    /**
     * @var Json
     */
    protected $serialize;

    public function __construct(
        \Magento\Catalog\Block\Product\Context $context,
        \Magento\Framework\Stdlib\ArrayUtils $arrayUtils,
        AttachmentRepository $attachmentRepository,
        Json $serialize,
        array $data = [])
    {
        $this->attacmentrepository = $attachmentRepository;
        $this->serialize = $serialize;
        parent::__construct($context, $arrayUtils, $data);
    }

    /**
     * @var Product
     */
    protected $product;


    /**
     * Set product to block
     *
     * @param Product $product
     * @return $this
     */
    public function setProduct(Product $product)
    {
        $this->product = $product;
        return $this;
    }

    /**
     * Override parent function
     *
     * @return Product
     */
    public function getProduct()
    {
        if (!$this->product) {
            $this->product = parent::getProduct();
        }

        return $this->product;
    }

    /**
     * @param $attachId
     * @return array|\Magenest\Attachments\Model\Attachments|mixed
     */
    public function getInfoAttachment($attachId) {
        try {
            return $this->attacmentrepository->getById($attachId);
        }catch (\Exception  $e) {}
        return [];
    }

    /**
     * @param Product $product
     * @return array
     */
    public function getCourseTimeline(Product $product) {
        if($product->getData('timeline') && !is_array($product->getData('timeline'))){
            return $this->serialize->unserialize($product->getData('timeline'));
        }
        return $product->getData('timeline');
    }
}
