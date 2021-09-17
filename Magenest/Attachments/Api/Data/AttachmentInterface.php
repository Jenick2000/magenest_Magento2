<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magenest\Attachments\Api\Data;

/**
 * Interface AttachmentInterface
 * @package Magenest\Attachments\Api\Data
 */
interface AttachmentInterface extends \Magento\Framework\Api\CustomAttributesDataInterface
{
    /**#@+
     * Constants defined for keys of the data array. Identical to the name of the getter in snake case
     */
    const ID = 'file_id';
    const PATH = 'path';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const FILE_NAME = 'file_name';
    const FILE_LABEL = 'file_label';
    const VISIBLE = 'visible';
    const INCLUDE_ON_ORDER = 'include_on_order';
    const CUSTOMER_GROUPS = 'customer_group_ids';
    /**#@-*/

    /**
     * Get attachment id
     *
     * @return int|null
     */
    public function getId();

    /**
     * Set attachment id
     *
     * @param int $id
     * @return $this
     */
    public function setId($id);

    /**
     * Get attachment path
     *
     * @return string|null
     */
    public function getPath();

    /**
     * Set attachment path
     *
     * @param string $path
     * @return $this
     */
    public function setPath($path);

    /**
     * Get attachment label
     *
     * @return string|null
     */
    public function getFileLabel();

    /**
     * Set attachment label
     *
     * @param string $label
     * @return $this
     */
    public function setFileLabel($label);

    /**
     * Get attachment name
     *
     * @return string|null
     */
    public function getFileName();

    /**
     * Set attachment name
     *
     * @param string $name
     * @return $this
     */
    public function setFileName($name);


    /**
     * Get attachment visible
     *
     * @return int|null
     */
    public function getVisible();

    /**
     * Set attachment visible
     *
     * @param int $visible
     * @return $this
     */
    public function setVisible($visible);

    /**
     * Get attachment include in order
     *
     * @return int|null
     */
    public function getIncludeOnOrder();

    /**
     * Set attachment include in order
     *
     * @param int $includeOnOrder
     * @return $this
     */
    public function setIncludeOnOrder($includeOnOrder);

    /**
     * Get customer group ids
     *
     * @return int|null
     */
    public function getCustomerGroupIds();

    /**
     * Set group ids
     *
     * @param int $groupIds
     * @return $this
     */
    public function setCustomerGroupIds($groupIds);

    /**
     * Get created at time
     *
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created at time
     *
     * @param string $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt);

    /**
     * Get updated at time
     *
     * @return string|null
     */
    public function getUpdatedAt();

    /**
     * Set updated at time
     *
     * @param string $updatedAt
     * @return $this
     */
    public function setUpdatedAt($updatedAt);

}
