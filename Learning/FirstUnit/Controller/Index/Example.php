<?php

namespace Learning\FirstUnit\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

class Example extends Action
{
    public $title;
    public $name;
    /**
     * @var \Magento\Framework\App\ProductMetadataInterface
     */
    protected $productMetadata;

    public function __construct(Context $context, \Magento\Framework\App\ProductMetadataInterface $productMetadata)
    {
        $this->productMetadata = $productMetadata;
        parent::__construct($context);
    }

    public function execute()
    {
        $this->setTitle('Welcome');
        echo $this->getTitle() . '<br>';
        echo $this->getName('test') . '<br>';
        echo 'Magento version: ' . $this->productMetadata->getVersion();
    }

    public function setTitle($title)
    {
        return $this->title = $title;

    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getName($name)
    {
        return $name;
    }

}