<?php

namespace Magenest\Movie\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     * @throws \Zend_Db_Exception
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        /**
         * Create table 'magenest_actor'
         */
        $table = $installer->getConnection()
            ->newTable($installer->getTable('magenest_actor'))
            ->addColumn(
                'actor_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Actor ID'
            )
            ->addColumn(
                'name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                64,
                ['nullable' => false],
                'Fullname'
            )
            ->setComment('Magenest Actor Table');
        $installer->getConnection()->createTable($table);

        /**
         * Create table 'magenest_director'
         */
        $table = $installer->getConnection()
            ->newTable($installer->getTable('magenest_director'))
            ->addColumn(
                'director_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Director ID'
            )
            ->addColumn(
                'name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                64,
                ['nullable' => false],
                'Fullname'
            )
            ->setComment('Magenest Actor Table');
        $installer->getConnection()->createTable($table);
        /**
         * Create table 'magenest_movie'
         */
        $table = $installer->getConnection()
            ->newTable($installer->getTable('magenest_movie'))
            ->addColumn(
                'movie_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Movie ID'
            )
            ->addColumn(
                'name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                64,
                ['nullable' => false],
                'Movie name'
            )
            ->addColumn(
                'description',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Description name'
            )
            ->addColumn(
                'rating',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => false],
                'Rating'
            )
            ->addColumn(
                'director_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => true],
                'Director ID'
            )
            ->addForeignKey(
                $installer->getFkName(
                    'magenest_movie',
                    'director_id',
                    'magenest_director',
                    'director_id'
                ),
                'director_id',
                $installer->getTable('magenest_director'),
                'director_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            )
            ->setComment('Magenest Movie Table');
        $installer->getConnection()->createTable($table);

        /**
         * Create table 'magenest_movie_actor'
         */
        $table = $installer->getConnection()
            ->newTable($installer->getTable('magenest_movie_actor'))
            ->addColumn(
                'id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'ID'
            )
            ->addColumn(
                'movie_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => false],
                'Director ID'
            )
            ->addColumn(
                'actor_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => false],
                'Actor ID'
            )
            ->addForeignKey(
                $installer->getFkName(
                    'magenest_movie_actor',
                    'movie_id',
                    'magenest_movie',
                    'movie_id'
                ),
                'movie_id',
                $installer->getTable('magenest_movie'),
                'movie_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            )
            ->addForeignKey(
                $installer->getFkName(
                    'magenest_movie_actor',
                    'actor_id',
                    'magenest_actor',
                    'actor_id'
                ),
                'actor_id',
                $installer->getTable('magenest_actor'),
                'actor_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            )
            ->setComment('Magenest Movie Actor Table');
        $installer->getConnection()->createTable($table);
        $installer->endSetup();
    }
}