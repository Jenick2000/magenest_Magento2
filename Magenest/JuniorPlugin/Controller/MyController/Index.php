<?php

namespace Magenest\JuniorPlugin\Controller\MyController;

use Magento\Framework\App\Action\Action;
use Magenest\JuniorPlugin\Api\MyInterface;
use Magento\Framework\App\Action\Context;

class Index extends Action
{


    /**
     * @var MyInterface
     */
    public $myInterface;

    public function __construct(Context $context, MyInterface $myInterface)
    {
        parent::__construct($context);

        $this->myInterface = $myInterface;
    }

    public function execute()
    {
        $this->myInterface->foo();
        $this->myInterface->hi();
    }


}