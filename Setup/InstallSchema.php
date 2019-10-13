<?php

namespace Magenests\XuanHai\Setup;

use Magento\Eav\Setup\EavSetupFactory;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;
class InstallSchema implements InstallSchemaInterface
{
    private $eavSetupFactory;

    private $customerSetupFactory;
    public function __construct(

        eavSetupFactory $eavSetupFactory,
        CustomerSetupFactory $customerSetupFactory
    )
    {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->customerSetupFactory = $customerSetupFactory;
    }
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    )
    {
        $setup->startSetup();
        $mainTable = $setup->getTable('magenest_test_vendor_xuanhai');
        if ($setup->getConnection()->isTableExists($mainTable) != true) {
            $table = $setup->getConnection()
                ->newTable($mainTable)
                ->addColumn(
                    'id',
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'unsigned' => true,
                        'nullable' => false,
                        'primary' => true
                    ],
                    'id'
                )
                ->addColumn(
                    'customer_id',
                    Table::TYPE_INTEGER,
                    11,
                    [
                        'unsigned' => true,
                        'nullable' => false
                    ],
                    'name'
                )
                ->addColumn('first_name',
                    Table::TYPE_TEXT,
                    255,
                    [
                        'unsigned' => true,
                        'nullable' => false
                    ],
                    'first name'
                )
                ->addColumn(
                    'last_name',
                    Table::TYPE_TEXT,
                    255,
                    [
                        'unsigned' => true,
                        'nullable' => false
                    ],
                    'last name'
                )
                ->addColumn(
                    'email',
                    Table::TYPE_TEXT,
                    255,
                    [
                        'unsigned' => true,
                        'nullable' => false
                    ],
                    'email'
                )
                ->addColumn(
                    'company',
                    Table::TYPE_TEXT,
                    null,
                    [
                        'unsigned' => true,
                        'nullable' => false
                    ],
                    'company'
                )
                ->addColumn(
                    'phone_number',
                    Table::TYPE_TEXT,
                    15,
                    [
                        'unsigned' => true,
                        'nullable' => false
                    ],
                    'phone number'
                )
                ->addColumn(
                    'fax',
                    Table::TYPE_TEXT,
                    20,
                    [
                        'unsigned' => true,
                        'nullable' => false
                    ],
                    'fax'
                )
                ->addColumn(
                    'address',
                    Table::TYPE_TEXT,
                    null,
                    [
                        'unsigned' => true,
                        'nullable' => false
                    ],
                    'address'
                )
                ->addColumn(
                    'street',
                    Table::TYPE_TEXT,
                    null,
                    [
                        'unsigned' => true,
                        'nullable' => false
                    ],
                    'street'
                )
                ->addColumn(
                    'country',
                    Table::TYPE_TEXT,
                    null,
                    [
                        'unsigned' => true,
                        'nullable' => false
                    ],
                    'country'
                )
                ->addColumn(
                    'city',
                    Table::TYPE_TEXT,
                    50,
                    [
                        'unsigned' => true,
                        'nullable' => false
                    ],
                    'city'
                )
                ->addColumn(
                    'postcode',
                    Table::TYPE_TEXT,
                    20,
                    [
                        'unsigned' => true,
                        'nullable' => false
                    ],
                    'postcode'
                )
                ->addColumn(
                    'total_sales',
                    Table::TYPE_FLOAT,
                    11,
                    [
                        'unsigned' => true,
                        'nullable' => false
                    ],
                    'total sales'
                );
            $setup->getConnection()->createTable($table);
        }
        $setup->endSetup();
    }
    public function installa(
        ModuleDataSetupInterface $setup
    ) {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $eavSetup->addAttribute(
            \Magento\Customer\Model\Customer::ENTITY,
            'xuanhai_is_approved',
            [
                'type'         => 'int',
                'label' => 'Hai is approved',
                'input' => 'select',
                'source' => 'Magenests\XuanHai\Model\Config\Source\MyCustomerType',
                'required'     => true,
                'backend' => '',
                'sort_order' => 15,
                'global' => \Magento\Catalog\Model\ResourceModel\Eav\Attribute::SCOPE_GLOBAL,
                'used_in_product_listing' => false,
                'visible_on_front' => false                ]
        );
        $setup->endSetup();
    }

}