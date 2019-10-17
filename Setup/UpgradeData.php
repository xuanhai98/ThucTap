<?php

namespace Magenest3\XuanHai\Setup;

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
        if (version_compare($context->getVersion(), '1.0.1')< 0) {

            /* @var  EavSetup $eavSetup */
            $eavSetup->removeAttribute('catalog_product', 'roomtype');
            $eavSetup->addAttribute(
                \Magento\Catalog\Model\Product::ENTITY,
                'roomtype',
                [
                    'group' => 'General',
                    'type' => 'varchar',
                    'label' => 'Room Type',
                    'backend' => '',
                    'input' => 'select',
                    'wysiwyg_enabled' => false,
                    'source' => 'Magenest3\XuanHai\Model\Config\Source\RoomType',
                    'required' => false,
                    'sort_order' => 15,
                    'global' => \Magento\Catalog\Model\ResourceModel\Eav\Attribute::SCOPE_GLOBAL,
                    'used_in_product_listing' => false,
                    'visible_on_front' => false,
                ]
            );
        }
        $setup->endSetup();
    }
}