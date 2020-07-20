<?php


use Magento\Framework\View\Element\UiComponent\Context;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

 class GenericButton implements  ButtonProviderInterface{

     protected $urlBuilder;


     protected $_authorization;

     public function __construct(
         Context $context,
         \Magento\Framework\AuthorizationInterface $authorization
     ) {
         $this->context = $context;
         $this->_authorization = $authorization;
     }

     /**
      * Return the customer Id.
      *
      * @return int|null
      */
     public function getSubscriptionId()
     {
         return (int)$this->context->getRequest()->getParam('id');
     }

     /**
      * Generate url by route and parameters
      *
      * @param   string $route
      * @param   array $params
      * @return  string
      */
     public function getUrl($route = '', $params = [])
     {
         return $this->context->getUrlBuilder()->getUrl($route, $params);
     }
     public function getButtonData()
     {
         // TODO: Implement getButtonData() method.
         return [];
     }
     protected function _isAllowedAction($resourceId)
     {
         return $this->_authorization->isAllowed($resourceId);
     }
 }