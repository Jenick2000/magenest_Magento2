<?php

namespace Learning\FirstUnit\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class CheckCartQtyObserver implements ObserverInterface
{


    public function execute(Observer $observer)
    {
        if ($observer->getProduct()->getQty() >= 3) {

            throw new \Exception('Qty must be less than 3');

        }
    }

}