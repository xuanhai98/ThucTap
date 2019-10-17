<?php
namespace Magenest3\XuanHai\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $conn = $setup->getConnection();
        $tableName = $setup->getTable('magenest_test_hotel_xuanhai');
        if ($conn->isTableExists($tableName) != true) {
            $table = $conn->newTable($tableName)
                ->addColumn(
                    'hotel_id',
                    Table::TYPE_INTEGER,
                    null,
                    ['identity'=>true,'unsigned'=>true,'nullable'=>false,'primary'=>true]
                )
                ->addColumn(
                    'hotel_name',
                    Table::TYPE_TEXT,
                    100,
                    ['nullable'=>false,'default'=>'']
                )
                ->addColumn(
                    'location_street',
                    Table::TYPE_TEXT,
                    null,
                    ['nullable'=>false,'default'=>'']
                )
                ->addColumn(
                    'location_city',
                    Table::TYPE_TEXT,
                    50,
                    ['nullable'=>false,'default'=>'']
                )
                ->addColumn(
                    'location_state',
                    Table::TYPE_TEXT,
                    50,
                    ['nullable'=>false,'default'=>'']
                )
                ->addColumn(
                    'location_country',
                    Table::TYPE_TEXT,
                    10,
                    ['nullable'=>false,'default'=>'']
                )
                ->addColumn(
                    'contact_phone',
                    Table::TYPE_TEXT,
                    20,
                    ['nullable'=>false,'default'=>'']
                )
                ->addColumn(
                    'total_available_room',
                    Table::TYPE_INTEGER,
                    ['nullable'=>false,'default'=>0]
                )
                ->addColumn(
                    'available_single',
                    Table::TYPE_INTEGER,
                    100,
                    ['nullable'=>false,'default'=>0]
                )
                ->addColumn(
                    'available_double',
                    Table::TYPE_INTEGER,
                    100,
                    ['nullable'=>false,'default'=>0]
                )
                ->addColumn(
                    'available_triple',
                    Table::TYPE_INTEGER,
                    1000,
                    ['nullable'=>false,'default'=>0]
                )
                ->setOption('charset', 'utf8');
            $conn->createTable($table);
        }
        $setup->endSetup();
    }
}
