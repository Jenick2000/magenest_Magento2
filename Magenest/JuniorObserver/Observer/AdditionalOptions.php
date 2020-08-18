<?php

namespace Magenest\JuniorObserver\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Serialize\SerializerInterface;
use Magento\Framework\App\RequestInterface;


class AdditionalOptions implements ObserverInterface
{

    /**
     * @var SerializerInterface
     */
    protected $serializer;
    /**
     * @var RequestInterface
     */
    protected $_request;

    public function __construct(SerializerInterface $serializer, RequestInterface $request)
    {
        $this->serializer = $serializer;
        $this->_request = $request;
    }

    public function execute(Observer $observer)
    {
        $productOrder = $observer->getData('product');
        $quote = $observer->getData('quote_item');

        $additionalOptions = array();

        if ($additionalOption = $quote->getOptionByCode('additional_options')) {
            $additionalOptions = (array)unserialize($additionalOption->getValue());
        }
        $post = $this->_request->getParam('delivery_time');

        if (is_array($post)) {
            foreach ($post as $key => $value) {
                if ($key == '' || $value == '') {
                    continue;
                }

                $additionalOptions[] = [
                    'label' => $key,
                    'value' => $value
                ];
            }
        } else if ($post != '') {
            $additionalOptions[] = [
                'label' => 'Delivery Time',
                'value' => $post
            ];
        }

        if (count($additionalOptions) > 0) {
            $quote->addOption(array(
                'product_id' => $productOrder->getId(),
                'code' => 'additional_options',
                'value' => $this->serializer->serialize($additionalOptions)
            ));
        }
    }
}