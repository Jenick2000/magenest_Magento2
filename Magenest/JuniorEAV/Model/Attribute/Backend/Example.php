<?php

namespace Magenest\JuniorEAV\Model\Attribute\Backend;

class Example extends \Magento\Eav\Model\Entity\Attribute\Backend\AbstractBackend
{

    public function afterLoad($object)
    {
        $value = $object->getData('example_eav');
        $len = strlen($value);
        $res = str_split($value, $len - 8);
        $object->setData('example_eav', $res[0]);
        return parent::afterLoad($object);
    }

    public function beforeSave($object)
    {
        $value = $object->getData('example_eav');
        $object->setData('example_eav', $value . '_varchar');
        return parent::beforeSave($object);
    }
}