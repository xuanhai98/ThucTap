<?php
namespace Project1\Test1\Setup;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;
class InstallSchema implements InstallSchemaInterface
{
    /**
     * Installs DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     * @throws \Zend_Db_Exception
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    )
    {
        $setup->startSetup();
        $mainTable = $setup->getTable('manufacturer_entity');
        if ($setup->getConnection()->isTableExists($mainTable) != true) {
            $table = $setup->getConnection()
                ->newTable($mainTable)
                ->addColumn(
                    'entity_id',
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'unsigned' => true,
                        'nullable' => false,
                        'primary' => true
                    ],
                    'entity id'
                )
                ->addColumn(
                    'name',
                    Table::TYPE_TEXT,
                    255,
                    [
                        'unsigned' => true,
                        'nullable' => false
                    ],
                    'name'
                )
                ->addColumn('enabled',
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'unsigned' => true,
                        'nullable' => false
                    ],
                    'enabled'
                )
            ->addColumn(
                'address_street',
                Table::TYPE_TEXT,
                255,
                [
                    'unsigned' => true,
                    'nullable' => false
                ],
                'address street'
            )
            ->addColumn(
                'address_city',
                Table::TYPE_TEXT,
                100,
                [
                    'unsigned' => true,
                    'nullable' => false
                ],
                'address city'
            )
            ->addColumn(
                'address_country',
                Table::TYPE_TEXT,
                50,
                [
                    'unsigned' => true,
                    'nullable' => false
                ],
                'address country'
            )
            ->addColumn(
                'contact_name',
                Table::TYPE_TEXT,
                100,
                [
                    'unsigned' => true,
                    'nullable' => false
                ],
                'contact name'
            )
            ->addColumn(
                'contact_phone',
                Table::TYPE_TEXT,
                20,
                [
                    'unsigned' => true,
                    'nullable' => false
                ],
                'contact phone'
            );
            $setup->getConnection()->createTable($table);
        }
        $setup->endSetup();
    }
}