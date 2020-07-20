<?php
namespace Learning\FirstUnit\Controller\Index;

class Redirect extends \Magento\Framework\App\Action\Action {

    function execute()
    {
        // TODO: Implement execute() method.
        return $this->_redirect('helloworld');
    }
}