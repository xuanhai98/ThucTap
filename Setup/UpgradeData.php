<?php

namespace Magenests\XuanHai\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;

class UpgradeData implements UpgradeDataInterface
{
    private $eavSetupFactory;

    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    public function upgrade(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    )
    {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        if (version_compare($context->getVersion(), '1.0.12')< 0) {

            /* @var  EavSetup $eavSetup */
            $eavSetup->addAttribute(
                \Magento\Customer\Model\Customer::ENTITY,
                'xuanhai_is_approved',
                [
                    'type'         => 'int',
                    'label' => 'Hai is approved',
                    'input' => 'text',
                    'backend' => '',
                    'required' => false,
                    'sort_order' => 15,
                    'global' => \Magento\Catalog\Model\ResourceModel\Eav\Attribute::SCOPE_GLOBAL,
                    'used_in_product_listing' => false,
                    'visible_on_front' => false                ]
            );
        }
        if (version_compare($context->getVersion(), '1.0.14')< 0) {

            /* @var  EavSetup $eavSetup */
            $eavSetup->removeAttribute('catalog_product', 'xuanhai_product_vendor');
            $eavSetup->addAttribute(
                \Magento\Catalog\Model\Product::ENTITY,
                'xuanhai_product_vendor',
                [
                    'group' => 'General',
                    'type' => 'varchar',
                    'label' => 'Hai_product_vendor',
                    'backend' => '',
                    'input' => 'select',
                    'wysiwyg_enabled' => false,
                    'source' => 'Magenests\XuanHai\Model\Config\Source\Product',
                    'required' => false,
                    'sort_order' => 14,
                    'global' => \Magento\Catalog\Model\ResourceModel\Eav\Attribute::SCOPE_GLOBAL,
                    'used_in_product_listing' => false,
                    'visible_on_front' => false,
                ]
            );
        }
        $setup->endSetup();
    }
}