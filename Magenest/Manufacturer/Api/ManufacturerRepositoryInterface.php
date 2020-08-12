<?php

namespace Magenest\Manufacturer\Api;

use Magenest\Manufacturer\Api\Data\ManufacturerInterface;

interface  ManufacturerRepositoryInterface
{

    /**
     * @param $id
     * @param bool $forceReload
     * @return ManufacturerInterface
     */
    public function getById($id, $forceReload = false);

    /**
     * @param ManufacturerInterface $manufacturer
     * @return \Magenest\Manufacturer\Api\Data\ManufacturerInterface
     */
    public function save($manufacturer);

    /**
     * @param ManufacturerInterface $manufacturer
     * @return void
     */
    public function delete($manufacturer);

    /**
     * @return mixed
     */
    public function getList();
}