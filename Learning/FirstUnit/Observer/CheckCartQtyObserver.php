<?php

namespace Learning\FirstUnit\Observer;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class CheckCartQtyObserver implements ObserverInterface {


    public function execute(Observer $observer)
    {
        // TODO: Implement execute() method.
        if ($observer->getProduct()->getQty()  >= 3) {
            //Odd qty
            throw new \Exception('Qty must be less than 3');
        }
    }
}