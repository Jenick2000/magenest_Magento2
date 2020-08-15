<?php

namespace Magenest\JuniorEAV\Model\Attribute\Backend;

class Example extends \Magento\Eav\Model\Entity\Attribute\Backend\AbstractBackend
{

    public function afterLoad($object)
    {
        $value = $object->getData('example_eav');
        if($value != '') {
            $len = strlen($value);
            if($len > 8){
                $res = str_split($value, $len - 8);
                $object->setData('example_eav', 'hello');
            }
        }
        return parent::afterLoad($object);
    }

    public function beforeSave($object)
    {
        $value = $object->getData('example_eav');
        $object->setData('example_eav', $value . '_varchar');
        return parent::beforeSave($object);
    }
}