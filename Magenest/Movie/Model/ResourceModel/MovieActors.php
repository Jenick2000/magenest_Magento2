<?php
namespace Magenest\Movie\Model\ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class MovieActors extends AbstractDb {

    protected function _construct()
    {
        // TODO: Implement _construct() method.
        $this->_init('magenest_movie_actor', 'id');
    }
}