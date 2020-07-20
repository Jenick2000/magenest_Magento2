<?php

namespace Magenest\Movie\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{


    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        try {

            // create table magenest_movie
            $table = $setup->getConnection()
                ->newTable($setup->getTable('magenest_movie'))
                ->addColumn(
                    'movie_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'primary' => true,
                        'nullable' => false,
                        'unsigned' => true
                    ],
                    'movie id'
                )->addColumn(
                    'name',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    null,
                    ['nullable' => false],
                    'name movie'
                )->addColumn(
                    'description',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    null,
                    ['default' => '']

                )->addColumn(
                    'rating',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null
                )->addForeignKey(
                    $setup->getFkName('magenest_movie', 'director_id', 'magesnest_director', 'director_id'),
                    'director_id',
                    $setup->getTable('magenest_director'),
                    'director_id',
                    \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                )->setComment('table movie ');

            $setup->getConnection()->createTable($table);

            // create table magenest_director
            $table = $setup->getConnection()->newTable($setup->getTable('magenest_director'))
                ->addColumn(
                    'director_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    [
                        'primary' => true,
                        'identity' => true,
                        'nullable' => false
                    ]
                )->addColumn(
                    'name',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    null
                )->setComment('table director');
            $setup->getConnection()->createTable($table);

            // create table magenest_actor
            $table = $setup->getConnection()->newTable($setup->getTable('magenest_actor'))
                ->addColumn(
                    'actor_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    [
                        'primary' => true,
                        'identity' => true,
                        'nullable' => false
                    ]
                )->addColumn(
                    'name',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    null
                )->setComment('table mocie actor');
            $setup->getConnection()->createTable($table);

            // create table magenest_movie_actor
            $table = $setup->getConnection()->newTable($setup->getTable('magenest_movie_actor'))
                            ->addForeignKey(
                                $setup->getFkName('magenest_movie_actor', 'movie_id', 'magenest_movie', 'movie_id'),
                                'movie_id',
                                $setup->getTable('magenest_movie'),
                                'movie_id',
                                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                            )
                            ->addForeignKey(
                                $setup->getFkName('magenest_movie_actor', 'actor_id', 'magenest_actor', 'actor_id'),
                                'actor_id',
                                $setup->getTable('magenest_actor'),
                                'actor_id',
                                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                            );

            $setup->getConnection()->createTable($table);

            } catch (\Zend_Db_Exception $e) {
                  return $e;
             }
    }
}