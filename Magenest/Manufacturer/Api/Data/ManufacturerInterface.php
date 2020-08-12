<?php

namespace Magenest\Manufacturer\Api\Data;

interface ManufacturerInterface
{

    /**
     * @return int
     */
    public function getId();

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getAddress();

    /**
     * @param $address
     * @return $this
     */
    public function setAddress($address);

    /**
     * @param $phone
     * @return $this
     */
    public function setContactPhone($phone);

    /**
     * @return string
     */
    public function getContactPhone();

    /**
     * @return mixed
     */
    public function getData();

    /**
     * @param $addCity
     * @return mixed
     */
    public function setAddressCity($addCity);

    /**
     * @param $addStreet
     * @return mixed
     */
    public function setAddressStreet($addStreet);

    /**
     * @param $addCountry
     * @return mixed
     */
    public function setAddressCountry($addCountry);

    /**
     * @param $contactName
     * @return mixed
     */
    public function setContactName($contactName);


}
