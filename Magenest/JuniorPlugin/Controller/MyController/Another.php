<?php


namespace Magenest\JuniorPlugin\Controller\MyController;


use Magento\Framework\App\Action\Action;
use Magenest\JuniorPlugin\Api\MyInterface;
use Magento\Framework\App\Action\Context;

class Another extends Action
{

    /**
     * @var MyInterface
     */
    protected $myInterface;

    public function __construct(Context $context, MyInterface $myInterface)
    {
        $this->myInterface = $myInterface;
        parent::__construct($context);
    }

    public function execute()
    {
        $this->myInterface->foo();
    }
}