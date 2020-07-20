<?php
namespace Learning\FirstUnit\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

class Collection extends Action {
protected $subCollectionFactory;
public function __construct(Context $context, \Magento\Customer\Model\ResourceModel\Customer\CollectionFactory $collectionFactory)
{
    $this->subCollectionFactory = $collectionFactory;
    parent::__construct($context);
}

    public function execute()
    {
        $productCollection = $this->_objectManager->create('Magento\Catalog\Model\ResourceModel\Product\Collection');
        $productCollection->addAttributeToSelect(['name', 'price', 'image']);
        $productCollection->addAttributeToFilter('sku', 'Nike air-white');

        //$productCollection->setDataToAll('price', 175); // edit attribute
        // $productCollection->setPageSize(3,1);
        //$outputSQLQueries =  $productCollection->getSelect()->__toString(); // show SQL queries
        //print_r($outputSQLQueries);
        // $productCollection->save();
        foreach($productCollection as $item){
            echo "<pre>";
            print_r($item->getData());
            echo "</pre>";
        }


        $subscriptionCollection = $this->subCollectionFactory->create();
       // $subscriptionCollection->addFieldToFilter('subscription_id', '1');
        $outputSQl = $subscriptionCollection->getSelect()->__toString();
//        $subscriptionCollection->setDataToAll('status', 'canceled');
//        $subscriptionCollection->setDataToAll(['firstname'=> 'asbc', 'status'=>'complete']);
//        $subscriptionCollection->setPageSize(5);
//        $subscriptionCollection->save();
        print_r($outputSQl);
        foreach ($subscriptionCollection as $item) {
            echo '<pre>';
            print_r($item->getData());
            echo '<pre>';
        }

    }



}