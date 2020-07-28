<?php
namespace Magenest\Manufacturer\Model;

class Manufacturer extends \Magento\Framework\Model\AbstractModel
{

    protected function _construct()
    {
        $this->_init('Magenest\Manufacturer\Model\ResourceModel\Manufacturer');
        parent::_construct();

    }
}