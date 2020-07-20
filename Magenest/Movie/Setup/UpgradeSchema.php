<?php
namespace Magenest\Movie\Setup;

use Magento\Backend\Test\Block\Widget\Tab;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use \Magento\Framework\DB\Ddl\Table;
class UpgradeSchema implements UpgradeSchemaInterface {

    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        // TODO: Implement upgrade() method.
        if(version_compare($context->getVersion(), '1.1.1') < 0) {



            // create table magenest_director
//            $table = $setup->getConnection()->newTable($setup->getTable('magenest_director'))
//                ->addColumn(
//                    'director_id',
//                    Table::TYPE_INTEGER,
//                    null,
//                    [
//                        'primary' => true,
//                        'identity' => true,
//                        'unsigned' => true,
//                        'nullable' => false,
//                    ]
//                )->addColumn(
//                    'name',
//                    Table::TYPE_TEXT,
//                    null
//                )->setComment('table director');
//            $setup->getConnection()->createTable($table);
//
//            $table = $setup->getConnection()->newTable($setup->getTable('magenest_movie'))
//                    ->addColumn(
//                        'movie_id',
//                        Table::TYPE_INTEGER,
//                        null,
//                        ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
//                        'movie id'
//                    )->addColumn(
//                        'name',
//                        Table::TYPE_TEXT,
//                        null
//                    )->addColumn(
//                        'description',
//                        Table::TYPE_TEXT,
//                        null,
//                        ['default' => ''],
//                        'description'
//                    )->addColumn(
//                        'rating',
//                        Table::TYPE_INTEGER,
//                        null
//                    )->addColumn(
//                        'director_id',
//                        Table::TYPE_INTEGER,
//                        null,
//                    ['unsigned' =>  true, 'nullable' => false],
//                    'director_id reference to magenest_director'
//                    )->addForeignKey(
//                        $setup->getFkName('magenest_movie', 'director_id', 'magesnest_director', 'director_id'),
//                        'director_id',
//                        $setup->getTable('magenest_director'),
//                        'director_id',
//                        Table::ACTION_CASCADE
//                    )->setComment('table movie ');
//                    $setup->getConnection()->createTable($table);


//            create table magenest_actor
//                $table = $setup->getConnection()->newTable($setup->getTable('magenest_actor'))
//                    ->addColumn(
//                        'actor_id',
//                        Table::TYPE_INTEGER,
//                        null,
//                        [
//                            'primary' => true,
//                            'identity' => true,
//                            'nullable' => false,
//                            'unsigned' => true
//                        ]
//                    )->addColumn(
//                        'name',
//                        Table::TYPE_TEXT,
//                        null
//                    )->setComment('table actor');
//                $setup->getConnection()->createTable($table);


            // create table magenest_movie_actor
            $table = $setup->getConnection()->newTable($setup->getTable('magenest_movie_actor'))
                ->addColumn(
                    'id',
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'primary' => true,
                        'identity' => true,
                        'nullable' => false,
                        'unsigned' => true]
                )
                ->addColumn(
                    'movie_id',
                    Table::TYPE_INTEGER,
                    null,
                    ['unsigned'=> true, 'nullable' => false]
                )
                ->addColumn(
                    'actor_id',
                    Table::TYPE_INTEGER,
                    null,
                    ['unsigned'=> true, 'nullable' => false]
                )
                ->addForeignKey(
                    $setup->getFkName('magenest_movie_actor', 'movie_id', 'magenest_movie', 'movie_id'),
                    'movie_id',
                    $setup->getTable('magenest_movie'),
                    'movie_id',
                    Table::ACTION_CASCADE
                )
                ->addForeignKey(
                    $setup->getFkName('magenest_movie_actor', 'actor_id', 'magenest_actor', 'actor_id'),
                    'actor_id',
                    $setup->getTable('magenest_actor'),
                    'actor_id',
                    Table::ACTION_CASCADE
                );
            $setup->getConnection()->createTable($table);

        }
    }

}