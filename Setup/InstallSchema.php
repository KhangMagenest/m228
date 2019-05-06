<?php

/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Movie\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;


class InstallSchema implements InstallSchemaInterface
{

    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {

        /**
         * Create table 'magenest_director'
         */
        $table = $setup->getConnection()
            ->newTable($setup->getTable('magenest_director'))
            ->addColumn(
                'director_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                [ 'identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true ],
                'Director ID'
            )
            ->addColumn(
                'name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [ 'nullable' => false, 'default' => '' ],
                'Name'
            )->setComment("Director table");
        $setup->getConnection()->createTable($table);

        /**
         * Create table 'magenest_actor'
         */
        $table = $setup->getConnection()
            ->newTable($setup->getTable('magenest_actor'))
            ->addColumn(
                'actor_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                [ 'identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true ],
                'Greeting ID'
            )
            ->addColumn(
                'name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [ 'nullable' => false, 'default' => '' ],
                'Name'
            )->setComment("Actor table");
        $setup->getConnection()->createTable($table);


        /**
         * Create table 'magenest_movie'
         */
        $table = $setup->getConnection()
            ->newTable($setup->getTable('magenest_movie'))
            ->addColumn(
                'movie_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                [ 'identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true ],
                'Movie ID'
            )
            ->addColumn(
                'name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [ 'nullable' => false, 'default' => '' ],
                'Name'
            )
            ->addColumn(
                'description',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [ 'nullable' => false, 'default' => '' ],
                'Name'
            )
            ->addColumn(
                'rating',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => false, 'default' => '0'],
                'Rating'
            )
            ->addColumn(
                'director_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => false, 'default' => '0'],
                'Director ID'
            )
            ->addForeignKey(
                $setup->getFkName(
                    'magenest_movie',
                    'director_id',
                    'magenest_director',
                    'director_id'
                ),
                'director_id',
                $setup->getTable('magenest_director'),
                'director_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            )->setComment("Movie table");
        $setup->getConnection()->createTable($table);

        /**
         * Create table 'magenest_movie_actor'
         */
        $table = $setup->getConnection()
            ->newTable($setup->getTable('magenest_movie_actor'))
            ->addColumn(
                'movie_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => false, 'default' => '0'],
                'Movie ID'
            )
            ->addColumn(
                'actor_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => false, 'default' => '0'],
                'Actor ID'
            )
            ->addForeignKey(
                $setup->getFkName(
                    'magenest_movie_actor',
                    'movie_id',
                    'magenest_movie',
                    'movie_id'
                ),
                'movie_id',
                $setup->getTable('magenest_movie'),
                'movie_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            )
            ->addForeignKey(
                $setup->getFkName(
                    'magenest_movie_actor',
                    'actor_id',
                    'magenest_actor',
                    'actor_id'
                ),
                'actor_id',
                $setup->getTable('magenest_actor'),
                'actor_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            )->setComment("Actor table");
        $setup->getConnection()->createTable($table);

    }
}