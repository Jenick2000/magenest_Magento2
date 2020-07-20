<?php
namespace Learning\FirstUnit\Ui\Component\Listing\Column;

class Options implements \Magento\Framework\Data\OptionSourceInterface {

    public function toOptionArray()
    {
        // TODO: Implement toOptionArray() method.
        return array(
            ['value'=>'pending', 'label'=>'Pending'],
            ['value'=>'complete', 'label'=>'Complete'],
            ['value' =>'canceled', 'label'=>'Canceled']
        );
    }
}