<?php

namespace Learning\HelloForm\Setup;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface {


    private $customerSetupFactory;

    public function __construct(\Magento\Customer\Setup\CustomerSetupFactory $customerSetupFactory)
    {
        $this->customerSetupFactory = $customerSetupFactory;
    }
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);
        $setup->startSetup();
        $customerSetup->addAttribute('customer',
            'nick_name', [
                'label' => 'Nick Name',
                'type' => 'static',
                'frontend_input' => 'text',
                'required' => false,
                'visible' => true,
                'position' => 105,
            ]);

        $nickNameAttribute = $customerSetup->getEavConfig()->getAttribute('customer', 'nick_name');
        $nickNameAttribute->setData('used_in_forms',['adminhtml_customer']);
        $nickNameAttribute->save();
        $setup->endSetup();
    }
}