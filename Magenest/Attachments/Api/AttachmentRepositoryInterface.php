<?php
namespace Magenest\Attachments\Api;
use Magenest\Attachments\Api\Data\AttachmentInterface;

interface AttachmentRepositoryInterface {

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id);

    /**
     * @param AttachmentInterface $attachment
     * @return mixed
     */
    public function save(AttachmentInterface $attachment);

    /**
     * @param int $id
     * @return bool
     */
    public function deleteById($id);

}
