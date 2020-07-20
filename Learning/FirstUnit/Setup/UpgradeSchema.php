<?php
namespace Learning\FirstUnit\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class UpgradeSchema implements  UpgradeSchemaInterface {

    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        if(version_compare($context->getVersion(), '1.0.1') < 0) {
            $installer = $setup;
            $installer->startSetup() ;
            //$installer->getConnection();
            // install new database table

            try {
                $table = $installer->getConnection()->newTable($installer->getTable('learning_firstunit_subscription')
                )->addColumn(
                    'subscription_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'unsigned' => true,
                        'nullable' => false,
                        'primary' => true
                    ],
                    'Subscriptions Id'
                )->addColumn(
                    'created_at',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    [
                        'nullable' => false,
                        'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT
                    ],
                    'Created at'
                )->addColumn(
                    'firstname',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    64,
                    ['nullable' => false],
                    'First Name'
                )->addColumn(
                    'lastname',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    64,
                    ['nullable' => false],
                    'Last name'
                )->addColumn(
                    'email',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable' => false],
                    'Email address'
                )->addColumn(
                    'status',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable' => false, 'default' => 'pending'],
                    'Status'
                )->addColumn(
                    'message',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    '64k',
                    [
                        'unsigned' => true,
                        'nullable' => false
                    ],
                    'Subscription notes'
                )->addIndex(
                    $installer->getIdxName('learning_firstunit_subscription', ['email']),
                    'email'
                )->setComment('Cron Schedule');

                $installer->getConnection()->createTable($table);
                $installer->endSetup();
            }
            catch (\Zend_Db_Exception $e) {
                return 'error'.$e;
            }


        }
   }
}