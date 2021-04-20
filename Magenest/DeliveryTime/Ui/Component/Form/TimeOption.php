<?php
namespace Magenest\DeliveryTime\Ui\Component\Form;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use Magento\Eav\Model\Entity\Attribute\Source\SourceInterface;
use Magento\Framework\Data\OptionSourceInterface;

class TimeOption extends AbstractSource implements SourceInterface, OptionSourceInterface {



    public function getAllOptions()
    {

        $times = [];
        for ($time = 0; $time <= 23; $time++) {
            $label = ($time < 10) ? '0'.$time.' : 00': $time.' : 00';
            $times[] =  array('value'=> $time, 'label'=> $label);
        }
        return $times;
    }
}
