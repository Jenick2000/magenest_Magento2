<?php

namespace Learning\FirstUnit\Observer;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class RegisterVisitObserver implements  ObserverInterface{

    protected $_logger;
    public function __construct(\Psr\Log\LoggerInterface $logger)
    {
        $this->_logger = $logger;
    }

    public function execute(Observer $observer)
    {
        // TODO: Implement execute() method.
        $product = $observer->getProduct();
        $category = $observer->getCategory();

        //var_dump($product);
        $this->_logger->debug(print_r($product->debug(),true));
        $this->_logger->debug(print_r($category->debug(), true));

    }
}