<?php

namespace Magenest\Cybergame\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magenest\Cybergame\Model\GamerAccountListFactory;
use Magenest\Cybergame\Model\ResourceModel\GamerAccountList\CollectionFactory;

class UpdateAccountGame implements ObserverInterface
{

    /**
     * @var GamerAccountListFactory
     */
    protected $gameAccountList;
    /**
     * @var CollectionFactory
     */
    protected $accountCollection;

    public function __construct(GamerAccountListFactory $accountListFactory, CollectionFactory $accountCollection)
    {
        $this->gameAccountList = $accountListFactory;
        $this->accountCollection = $accountCollection;
    }

    public function execute(Observer $observer)
    {
        $order = $observer->getData('order');
        $items = $order->getItems();


        foreach ($items as $item) {
            $product_id = $item->getData('product_id');
            $qty = $item->getData('qty_ordered');
            $account_name = $item->getData('product_options')['info_buyRequest']['account_name'];

            $accountGame = $this->gameAccountList->create();
            $accountList = $this->accountCollection->create();
            $accountList->addFieldToFilter('account_name', $account_name);
            $result = $accountList->getData();

            if (count($result) == 0) {
                $accountGame->setProductId($product_id);
                $accountGame->setAccountName($account_name);
                $accountGame->setPassword(1);
                $accountGame->setHour($qty);
                $accountGame->save();
            } else {
                $accountGame->load($result[0]['id']);
                $accountGame->setProductId($product_id);
                $hour = $accountGame->getHour() + $qty;
                $accountGame->setHour($hour);
                $accountGame->save();
            }
        }
    }
}