<?php

namespace Learning\CustomerAttribute\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;


class upgradeData implements UpgradeDataInterface {

    private $customerSetupFactory;

    public function __construct(\Magento\Customer\Setup\CustomerSetupFactory $customerSetupFactory)
    {
        $this->customerSetupFactory = $customerSetupFactory;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        // TODO: Implement upgrade() method.
        if(version_compare($context->getVersion(), '2.0.8') < 0) {


            $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);
            $setup->startSetup();
            $customerSetup->addAttribute('customer',
                'nickname',
                [
                    'label' => 'Nick Name',
                    'type' => 'static',
                    'frontend_input' => 'text',
                    'required' => false,
                    'visible' => true,
                    'position' => 105,
                    'system' => 0
                ]
            );

            $nickNameAttribute = $customerSetup->getEavConfig()->getAttribute('customer', 'nickname');
            $nickNameAttribute->setData('used_in_forms', ['adminhtml_customer']);
            $nickNameAttribute->save();
            $setup->endSetup();

        }
    }
}