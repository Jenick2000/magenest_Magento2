<?php

namespace Magenest\HotelBooking\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{

    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $connection = $setup->getConnection();
        $table = $connection->newTable($setup->getTable('hotel'))
            ->addColumn(
                'hotel_id',
                Table::TYPE_INTEGER,
                null,
                [
                    'primary' => true,
                    'identity' => true,
                    'unsigned' => true,
                    'nullable' => false
                ]
            )->addColumn(
                'hotel_name',
                Table::TYPE_TEXT,
                100
            )->addColumn(
                'location_street',
                Table::TYPE_TEXT
            )->addColumn(
                'location_city',
                Table::TYPE_TEXT,
                50
            )->addColumn(
                'location_state',
                Table::TYPE_TEXT,
                50
            )->addColumn(
                'location_country',
                Table::TYPE_TEXT,
                10
            )->addColumn(
                'contact_phone',
                Table::TYPE_TEXT,
                20
            )->addColumn(
                'total_available_room',
                Table::TYPE_INTEGER
            )->addColumn(
                'available_single',
                Table::TYPE_INTEGER,
                100
            )->addColumn(
                'available_double',
                Table::TYPE_INTEGER,
                100
            )->addColumn(
                'available_triple',
                Table::TYPE_INTEGER,
                1000
            )->setComment('this is hotel booking system table');
        $setup->getConnection()->createTable($table);
//        $connection->addIndex(
//            'hotel',
//            'hotel_name',
//            [
//                'location_street', 'location_city', 'location_state', 'location_country', 'contact_phone'
//            ]
//        );
    }
}