<?php

namespace Magenest\Manufacturer\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), '1.1.1') < 0) {

            $connection = $setup->getConnection();

            $table = $connection->newTable($setup->getTable('manufacturer_entity'))
                ->addColumn(
                    'manufacturer_id',
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'primary' => true,
                        'identity' => true,
                        'unsigned' => true,
                        'nullable' => false
                    ]
                )
                ->addColumn(
                    'name',
                    Table::TYPE_TEXT,
                    255
                )
                ->addColumn(
                    'enabled',
                    Table::TYPE_INTEGER,
                    1
                )
                ->addColumn(
                    'address_street',
                    Table::TYPE_TEXT,
                    255
                )
                ->addColumn(
                    'address_city',
                    Table::TYPE_TEXT,
                    100
                )
                ->addColumn(
                    'address_country',
                    Table::TYPE_TEXT,
                    5
                )
                ->addColumn(
                    'contact_name',
                    Table::TYPE_TEXT,
                    100
                )->addColumn(
                    'contact_phone',
                    Table::TYPE_TEXT,
                    20
                );
            $setup->getConnection()->createTable($table);
            $connection->addIndex(
                'manufacturer_entity',
                'name',
                [
                    'name', 'address_country', 'address_city', 'contact_name'
                ],
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
            );
        }
    }
}
