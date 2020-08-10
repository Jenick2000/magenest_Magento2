<?php

namespace Magenest\Cybergame\Model\Import;

use Exception;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\Json\Helper\Data as JsonHelper;
use Magento\ImportExport\Helper\Data as ImportHelper;
use Magento\ImportExport\Model\Import;
use Magento\ImportExport\Model\Import\Entity\AbstractEntity;
use Magento\ImportExport\Model\Import\ErrorProcessing\ProcessingErrorAggregatorInterface;
use Magento\ImportExport\Model\ResourceModel\Helper;
use Magento\ImportExport\Model\ResourceModel\Import\Data;
use Magento\Catalog\Model\CategoryFactory;


/**
 * Class Courses
 */
class Categories extends AbstractEntity
{
    const ENTITY_CODE = 'catalog_category';
    const TABLE = 'catalog_category_entity';
    const ENTITY_ID_COLUMN = 'entity_id';

    /**
     * If we should check column names
     */
    protected $needColumnCheck = true;

    /**
     * Need to log in import history
     */
    protected $logInHistory = true;

    /**
     * Permanent entity columns.
     */
    protected $_permanentAttributes = [
        'entity_id'
    ];

    /**
     * Valid column names
     */
    protected $validColumnNames = [
        'entity_id',
        'parent_id',
        'path',
        'name',
        'position',
        'level',
        'is_active'
    ];

    /**
     * @var AdapterInterface
     */
    protected $connection;

    /**
     * @var ResourceConnection
     */
    private $resource;
    /**
     * @var CategoryFactory
     */
    protected $_categoryFactory;
    protected $allIdCategories = array();

    /**
     * Courses constructor.
     *
     * @param JsonHelper $jsonHelper
     * @param ImportHelper $importExportData
     * @param Data $importData
     * @param ResourceConnection $resource
     * @param Helper $resourceHelper
     * @param CategoryFactory $categoryFactory
     * @param ProcessingErrorAggregatorInterface $errorAggregator
     */

    public function __construct(
        JsonHelper $jsonHelper,
        ImportHelper $importExportData,
        Data $importData,
        ResourceConnection $resource,
        Helper $resourceHelper,
        CategoryFactory $categoryFactory,
        ProcessingErrorAggregatorInterface $errorAggregator
    )
    {
        $this->jsonHelper = $jsonHelper;
        $this->_importExportData = $importExportData;
        $this->_resourceHelper = $resourceHelper;
        $this->_dataSourceModel = $importData;
        $this->resource = $resource;
        $this->connection = $resource->getConnection(ResourceConnection::DEFAULT_CONNECTION);
        $this->errorAggregator = $errorAggregator;
        $this->_categoryFactory = $categoryFactory;
        $this->initMessageTemplates();
    }

    /**
     * Entity type code getter.
     *
     * @return string
     */
    public function getEntityTypeCode()
    {
        return static::ENTITY_CODE;
    }

    /**
     * Get available columns
     *
     * @return array
     */
    public function getValidColumnNames(): array
    {
        return $this->validColumnNames;
    }

    /**
     * Row validation
     *
     * @param array $rowData
     * @param int $rowNum
     *
     * @return bool
     */
    public function validateRow(array $rowData, $rowNum): bool
    {

        $name = $rowData['name'] ?? '';
        $path = $rowData['path'] ?? '';
        $position = (int)$rowData['position'] ?? 0;
        $parent_id = (int)$rowData['parent_id'];
        $entity_id = $rowData['entity_id'];
        $category = $this->_categoryFactory->create();
        $existParent = $category->load($parent_id)->getId();

        array_push($this->allIdCategories, $entity_id);
        $checkIdInTable = in_array($parent_id, $this->allIdCategories);

        if (!$existParent && !$checkIdInTable) {
            $this->addRowError('ParentIdNotFound', $rowNum);
        }
        if ($entity_id != '' && !is_numeric($entity_id)) {
            $this->addRowError('EntityIdNotNumberic', $rowNum);
        }
        if (!$name) {
            $this->addRowError('NameIsRequired', $rowNum);
        }

        if (!$path) {
            $this->addRowError('PathIsRequired', $rowNum);
        }


        if (isset($this->_validatedRows[$rowNum])) {
            return !$this->getErrorAggregator()->isRowInvalid($rowNum);
        }

        $this->_validatedRows[$rowNum] = true;

        return !$this->getErrorAggregator()->isRowInvalid($rowNum);
    }

    /**
     * Import data
     *
     * @return bool
     *
     * @throws Exception
     */
    protected function _importData(): bool
    {
        switch ($this->getBehavior()) {
            case Import::BEHAVIOR_DELETE:
                $this->deleteEntity();
                break;
            case Import::BEHAVIOR_REPLACE:
                $this->saveAndReplaceEntity();
                break;
            case Import::BEHAVIOR_APPEND:
                $this->saveAndReplaceEntity();
                break;
        }

        return true;
    }

    /**
     * Delete entities
     *
     * @return bool
     */
    private function deleteEntity(): bool
    {
        $rows = [];
        while ($bunch = $this->_dataSourceModel->getNextBunch()) {
            foreach ($bunch as $rowNum => $rowData) {
                $this->validateRow($rowData, $rowNum);

                if (!$this->getErrorAggregator()->isRowInvalid($rowNum)) {
                    $rowId = $rowData[static::ENTITY_ID_COLUMN];
                    $rows[] = $rowId;
                }

                if ($this->getErrorAggregator()->hasToBeTerminated()) {
                    $this->getErrorAggregator()->addRowToSkip($rowNum);
                }
            }
        }

        if ($rows) {
            return $this->deleteEntityFinish(array_unique($rows));
        }

        return false;
    }

    /**
     * Save and replace entities
     *
     * @return void
     */
    private function saveAndReplaceEntity()
    {
        $behavior = $this->getBehavior();
        $rows = [];
        while ($bunch = $this->_dataSourceModel->getNextBunch()) {
            $entityList = [];

            foreach ($bunch as $rowNum => $row) {
                if (!$this->validateRow($row, $rowNum)) {
                    continue;
                }

                if ($this->getErrorAggregator()->hasToBeTerminated()) {
                    $this->getErrorAggregator()->addRowToSkip($rowNum);

                    continue;
                }

                $rowId = $row[static::ENTITY_ID_COLUMN];
                $rows[] = $rowId;
                $columnValues = [];

                foreach ($this->getAvailableColumns() as $columnKey) {
                    $columnValues[$columnKey] = $row[$columnKey];
                }

                $entityList[$rowId][] = $columnValues;
                $this->countItemsCreated += (int)!isset($row[static::ENTITY_ID_COLUMN]);
                $this->countItemsUpdated += (int)isset($row[static::ENTITY_ID_COLUMN]);
            }

            if (Import::BEHAVIOR_REPLACE === $behavior) {
                if ($rows && $this->deleteEntityFinish(array_unique($rows))) {
                    $this->saveEntityFinish($entityList);
                }
            } elseif (Import::BEHAVIOR_APPEND === $behavior) {
                $this->saveEntityFinish($entityList);
            }
        }
    }

    /**
     * Save entities
     *
     * @param array $entityData
     *
     * @return bool
     */
    private function saveEntityFinish(array $entityData): bool
    {
        if ($entityData) {
            $rows = [];

            foreach ($entityData as $entityRows) {
                foreach ($entityRows as $row) {
                    $rows[] = $row;
                }
            }

            if ($rows) {

                foreach ($rows as $row) {
                    $category = $this->_categoryFactory->create();

                    if ($category->load($row['entity_id'])->getId()) {
                        $this->updateCategory($category, $row);
                    } else {
                        $this->addCategory($category, $row);
                    }

                }

                return true;
            }
            return false;
        }

    }

    public function updateCategory($category, $row)
    {
        $path = $row['path'] . '/' . $category->load($row['entity_id'])->getId();
        if ($row['name']) {
            $category->setName($row['name']);
        }
        $category->setLevel($row['level']);
        $category->setPath($path);
        $category->setParentId($row['parent_id']);
        $category->setPosition($row['position']);
        if ($row['is_active'] == 'true') {
            $category->setIsActive('1');
        } else {
            $category->setIsActive('0');
        }

        $category->setUrlKey($row['name']);
        $category->save();
    }

    public function addCategory($category, $row)
    {


        if ($row['entity_id']) {
            $category->setEntityId((int)$row['entity_id']);
        }
        $category->setName($row['name']);
        $category->setLevel((int)$row['level']);
        $category->setPath($row['path'] . '/' . $category->getId());
        $category->setParentId((int)$row['parent_id']);
        $category->setPosition((int)$row['position']);
        $category->setIsActive(boolval($row['is_active']));
        $category->setUrlKey($row['name']);
        $category->save();
    }

    /**
     * Delete entities
     *
     * @param array $entityIds
     *
     * @return bool
     */
    private function deleteEntityFinish(array $entityIds): bool
    {
        if ($entityIds) {
            try {

                foreach ($entityIds as $entityId) {

                    $category = $this->_categoryFactory->create()->load($entityId);
                    if ($category->getId()) {
                        $this->countItemsDeleted += 1;
                        $category->delete();
                    }
                }
                return true;
            } catch (Exception $e) {
                return false;
            }
        }

        return false;
    }

    /**
     * Get available columns
     *
     * @return array
     */
    private function getAvailableColumns(): array
    {
        return $this->validColumnNames;
    }

    /**
     * Init Error Messages
     */
    private function initMessageTemplates()
    {
        $this->addMessageTemplate(
            'NameIsRequired',
            __('The name cannot be empty.')
        );
        $this->addMessageTemplate(
            'PositionIsRequired',
            __('Duration should be greater than 0.')
        );
        $this->addMessageTemplate(
            'PathIsRequired',
            __('The Path cannot be empty')
        );
        $this->addMessageTemplate(
            'ParentIdNotFound',
            __('The Parent ID not found.')
        );
        $this->addMessageTemplate(
            'EntityIdNotNumberic',
            __('Entity ID must is numberic or null.')
        );
    }
}
