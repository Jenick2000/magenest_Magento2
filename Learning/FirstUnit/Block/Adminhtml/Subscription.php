<?php
namespace Learning\FirstUnit\Block\Adminhtml;

class Subscription extends  \Magento\Backend\Block\Widget\Grid\Container {


    protected function _construct()
    {
        $this->_blockGroup = 'Learning_FirstUnit';
        $this->_controller = 'adminhtml_subscription';
        parent::_construct(); // TODO: Change the autogenerated stub
    }
}
