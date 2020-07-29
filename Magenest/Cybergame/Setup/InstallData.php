<?php
namespace Magenest\Cybergame\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface{

    /**
     * @var \Magento\Customer\Setup\CustomerSetupFactory
     */
    protected $customerSetupFactory;

    public function __construct(\Magento\Customer\Setup\CustomerSetupFactory $customerSetupFactory)
    {
        $this->customerSetupFactory = $customerSetupFactory;
    }
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);
        $setup->startSetup();
        $customerSetup->addAttribute('customer',
            'is_manager',
            [
                'label' => 'Is Manager',
                'type' => 'int',
                'input'  => 'select',
                'source' => 'Magenest\Cybergame\Model\Attribute\Source\IsManager',
                'required' => false,
                'visible' => true,
                'position' => 120,
                'is_used_in_grid' => true,
                'is_visible_in_grid' => true,
                'is_filterable_in_grid' => true,
                'system' => 0
            ]
        );
        $nickNameAttribute = $customerSetup->getEavConfig()->getAttribute('customer', 'is_manager');
        $nickNameAttribute->setData('used_in_forms', ['adminhtml_customer']);
        $nickNameAttribute->save();
        $setup->endSetup();
    }
}