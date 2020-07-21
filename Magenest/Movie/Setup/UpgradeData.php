<?php
namespace Magenest\Movie\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;


class UpgradeData implements UpgradeDataInterface {

    /**
     * @var \Magento\Customer\Setup\CustomerSetupFactory
     */
    protected $customerSetupFactory;

    public function __construct(\Magento\Customer\Setup\CustomerSetupFactory $customerSetupFactory)
    {
        $this->customerSetupFactory = $customerSetupFactory;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        if(version_compare($context->getVersion(), '1.1.3') < 0) {


            $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);
            $setup->startSetup();
            $customerSetup->addAttribute('customer',
                'logo_image',
                [
                    'label' => 'Logo Image',
                    'type' => 'varchar',
                    'input'  => 'image',
                    'required' => false,
                    'visible' => true,
                    'position' => 106,
                    'system' => 0
                ]
            );
            $nickNameAttribute = $customerSetup->getEavConfig()->getAttribute('customer', 'logo_image');
            $nickNameAttribute->setData('used_in_forms', ['adminhtml_customer']);
            $nickNameAttribute->save();
            $setup->endSetup();
        }
    }
}