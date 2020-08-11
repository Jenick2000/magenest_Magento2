<?php

namespace Magenest\JuniorEAV\Setup;

use Magento\Framework\Setup\InstallDataInterface;

class InstallData implements InstallDataInterface
{

    /**
     * @var \Magento\Eav\Setup\EavSetupFactory
     */
    protected $eavSetupFactory;

    public function __construct(\Magento\Eav\Setup\EavSetupFactory $eavSetupFactory)
    {

        $this->eavSetupFactory = $eavSetupFactory;
    }

    public function install(\Magento\Framework\Setup\ModuleDataSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context)
    {
        $eavSetup = $this->eavSetupFactory->create();
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'customer_group',
            [
                'group' => 'General',
                'type' => 'int',
                'label' => 'Customer Group',
                'input' => 'select',
                'required' => false,
                'sort_order' => 230,
                'source' => 'Magenest\JuniorEAV\Model\Attribute\Source\CustomerGroup',
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                'is_used_in_grid' => true,
                'is_visible_in_grid' => true,
                'is_filterable_in_grid' => true,
                'visible' => true,
                'system' => 0
            ]
        );
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'example_eav',
            [
                'group' => 'General',
                'type' => 'varchar',
                'label' => 'Example EAV',
                'input' => 'text',
                'required' => false,
                'sort_order' => 240,
                'backend' => 'Magenest\JuniorEAV\Model\Attribute\Backend\Example',
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                'is_used_in_grid' => true,
                'is_visible_in_grid' => true,
                'is_filterable_in_grid' => true,
                'visible' => true,
                'system' => 0
            ]
        );
    }
}