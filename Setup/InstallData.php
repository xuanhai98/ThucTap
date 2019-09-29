<?php

namespace Magenest\EavTest\Setup;


use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    private $_customerSetupFactory;
    public function __construct(
        \Magento\Customer\Setup\CustomerSetupFactory $customerSetupFactory
    ){
        $this->_customerSetupFactory = $customerSetupFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        /** @var CustomerSetup $customerSetup */
        $customerSetup = $this->_customerSetupFactory->create(['setup' => $setup]);
        $setup->startSetup();
        $customerSetup->addAttribute('customer', 'avatar', [
            'label' => 'Logo Image',
            'type' => 'varchar',
            'input' => 'image',
            'required' => false,
            'visible' => true,
            'position' => 5,
            'system' => false
        ]);
        $loyaltyAttribute = $customerSetup->getEavConfig()->getAttribute('customer', 'avatar');
        $loyaltyAttribute->setData('used_in_forms', ['adminhtml_customer','customer_account_create','customer_account_edit']);
        $loyaltyAttribute->save();
        $setup->endSetup();
    }
}