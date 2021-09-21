<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magenest\Attachments\Model\Product\Attribute\Backend;


use Magento\Framework\Serialize\Serializer\Json;

/**
 * Class TimeLine
 * @package Magenest\Attachments\Model\Product\Attribute\Backend
 */
class TimeLine extends \Magento\Eav\Model\Entity\Attribute\Backend\AbstractBackend
{
    /**
     * @var Json
     */
    private $serialize;

    public function __construct(Json $serialize)
    {
        $this->serialize = $serialize;
    }

    /**
     * Set attribute default value if value empty
     *
     * @param \Magento\Framework\DataObject $object
     * @return $this
     */
    public function beforeSave($object)
    {
        $attributeCode = $this->getAttribute()->getName();
        if(!empty($object->getData($attributeCode))) {
            $object->setData($attributeCode, $this->serialize->serialize($object->getData($attributeCode)));
        }

        return parent::beforeSave($object);
    }

    public function afterLoad($object)
    {
        $attributeCode = $this->getAttribute()->getName();
        if(!empty($object->getData($attributeCode))) {
            $object->setData($attributeCode, $this->serialize->unserialize($object->getData($attributeCode)));
        }
        return parent::afterLoad($object);
    }
}
