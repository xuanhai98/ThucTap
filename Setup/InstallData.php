<?php

namespace Magenes\Cybergame\Setup;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Model\Config;
use Magento\Customer\Model\Customer;

class InstallData implements InstallDataInterface
{
    private $eavSetupFactory;

    public function __construct(EavSetupFactory $eavSetupFactory, Config $eavConfig)
    {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->eavConfig       = $eavConfig;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $eavSetup->addAttribute(
            \Magento\Customer\Model\Customer::ENTITY,
            'is_manager',
            [
                'type' => 'int',
			'label' => 'Is Manager',
			'input' => 'boolean',
			'backend' => '',
			'user_define' => true,
			'required' => false,
			'visible' => true,
			'sort_order' => 15,
			'system' => 0,
			'is_used_in_grid' => true,
			'is_visible_in_grid' => true,
			'is_html_allowed_on_front' => true,
			'visible_on_front' => true

            ]
        );
        $sampleAttribute = $this->eavConfig->getAttribute(Customer::ENTITY, 'is_manager');

        // more used_in_forms ['adminhtml_checkout','adminhtml_customer','adminhtml_customer_address','customer_account_edit','customer_address_edit','customer_register_address']
        $sampleAttribute->setData(
            'used_in_forms',
            ['adminhtml_customer']

        );
        $sampleAttribute->save();
    }
}

