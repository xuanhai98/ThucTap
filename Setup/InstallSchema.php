<?php
namespace Magenes\CyberGame\Setup;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;
class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface{

    public function install(SchemaSetupInterface $setup,ModuleContextInterface $context){
        $setup->startSetup();
        $conn = $setup->getConnection();
        $tableGamerAccount = $setup->getTable('gamer_account_list');
        if($conn->isTableExists($tableGamerAccount) != true){
            $table = $conn->newTable($tableGamerAccount)
                ->addColumn(
                    'id',
                    Table::TYPE_INTEGER,
                    null,
                    ['identity'=>true,'unsigned'=>true,'nullable'=>false,'primary'=>true]
                )
                ->addColumn(
                    'product_id',
                    Table::TYPE_INTEGER,
                    null,
                    ['nullable'=>false,'default'=>0]
                )
                ->addColumn(
                    'account_name',
                    Table::TYPE_TEXT,
                    255,
                    ['nullbale'=>false,'default'=>'']
                )
                ->addColumn(
                    'password',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable'=>false,'default'=>'']
                )
                ->addColumn(
                    'hour',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable'=>false,'default'=>'']
                )
                ->addColumn(
                    'created_at',
                    Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable'=>false,'default'=>Table::TIMESTAMP_INIT],
                    'Created At'
                )
                ->addColumn(
                    'updated_at',
                    Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable'=>false,'default'=>Table::TIMESTAMP_INIT_UPDATE],
                    'Updated At'
                )
                ->setOption('charset','utf8');
            $conn->createTable($table);
        }
        $tableRoomExtra = $setup->getTable('room_extra_option');
        if($conn->isTableExists($tableRoomExtra) != true){
            $table = $conn->newTable($tableRoomExtra)
                ->addColumn(
                    'id',
                    Table::TYPE_INTEGER,
                    null,
                    ['identity'=>true,'unsigned'=>true,'nullable'=>false,'primary'=>true]
                )
                ->addColumn(
                    'product_id',
                    Table::TYPE_INTEGER,
                    null,
                    ['nullable'=>false,'default'=>0]
                )
                ->addColumn(
                    'number_pc',
                    Table::TYPE_INTEGER,
                    null,
                    ['nullbale'=>false,'default'=>0]
                )
                ->addColumn(
                    'address',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable'=>false,'default'=>'']
                )
                ->addColumn(
                    'food_price',
                    Table::TYPE_INTEGER,
                    null,
                    ['nullable'=>false,'default'=>0]
                )
                ->addColumn(
                    'drink_price',
                    Table::TYPE_INTEGER,
                    null,
                    ['nullable'=>false,'default'=>0]
                )
                ->addColumn(
                    'created_at',
                    Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable'=>false,'default'=>Table::TIMESTAMP_INIT],
                    'Created At'
                )
                ->addColumn(
                    'updated_at',
                    Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable'=>false,'default'=>Table::TIMESTAMP_INIT_UPDATE],
                    'Updated At'
                )->addColumn(
                    'room_name',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable'=>false,'default'=>0]
                )
                ->addColumn(
                    'price',
                    Table::TYPE_INTEGER,
                    null,
                    ['nullable'=>false,'default'=>0]
                )
                ->setOption('charset','utf8');
            $conn->createTable($table);
        }
        $setup->endSetup();
    }
}
