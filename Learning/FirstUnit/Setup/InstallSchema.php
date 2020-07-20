<?php

namespace Learning\FirstUnit\Setup;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements  InstallSchemaInterface
{

    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        /**
         * create table with name greeting_message
         */
        $table = $setup->getConnection()
            ->newTable(
                $setup->getTable('greeting_message'))
            ->addColumn(
                'greeting_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Greeting Id'
            )
            ->addColumn(
                'message',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false, 'default' => ''],
                'Message greeting'
            )
            ->setComment('Greeting message table');

        $setup->getConnection()->createTable($table);

    }
}