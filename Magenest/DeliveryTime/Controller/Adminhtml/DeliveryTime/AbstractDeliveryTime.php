<?php
namespace Magenest\DeliveryTime\Controller\Adminhtml\DeliveryTime;


use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\ForwardFactory;
use Magento\Framework\View\Result\PageFactory;
use Magenest\DeliveryTime\Model\DeliveryTimeFactory;
use Magento\Framework\Serialize\Serializer\Json;

abstract class AbstractDeliveryTime extends Action
{
    /**
     * @var string
     */
    const ADMIN_RESOURCE = 'Magenest_DeliveryTime::time';

    protected $_entityId = 'delivery_time_id';

    protected $_idField = 'id';


    /**
     * @var PageFactory
     */
    protected $resultPageFactory;


    /**
     * @var \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory
     */
    protected $categoryCollectionFactory;

    /**
     * @var ForwardFactory
     */
    protected $resultForwardFactory;
    /**
     * @var DeliveryTimeFactory
     */
    protected $deliveryTimeFactory;
    /**
     * @var Json
     */
    protected $serializer;

    /**
     * AbstractMessage constructor.
     * @param PageFactory $resultPageFactory
     * @param Context $context
     * @param ForwardFactory $resultForwardFactory
     * @param DeliveryTimeFactory $deliveryTimeFactory
     * @param Json $serializer
     */
    public function __construct(
        PageFactory $resultPageFactory,
        Context $context,
        ForwardFactory $resultForwardFactory,
        DeliveryTimeFactory $deliveryTimeFactory,
        Json $serializer
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->resultForwardFactory = $resultForwardFactory;
        $this->deliveryTimeFactory = $deliveryTimeFactory;
        $this->serializer = $serializer;
        parent::__construct($context);
    }

}
