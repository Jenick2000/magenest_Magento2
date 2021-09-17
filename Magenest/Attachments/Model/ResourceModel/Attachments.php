<?php

namespace Magenest\Attachments\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Attachments extends AbstractDb {

    protected $_serializableFields = ['path' => [[], []]];

    protected function _construct()
    {
        $this->_init('magenest_file_attachment', 'file_id');
    }
}
