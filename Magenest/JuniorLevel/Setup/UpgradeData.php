<?php

namespace Magenest\JuniorLevel\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;

class UpgradeData implements UpgradeDataInterface
{

    /**
     * @var \Magento\Eav\Setup\EavSetupFactory
     */
    protected $eavSetupFactory;

    public function __construct(\Magento\Eav\Setup\EavSetupFactory $eavSetupFactory)
    {

        $this->eavSetupFactory = $eavSetupFactory;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), '1.1.4') < 0) {
            $eavSetup = $this->eavSetupFactory->create();
            $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'time');
            $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'test_select');
            $eavSetup->addAttribute(
                \Magento\Catalog\Model\Product::ENTITY,
                'time',
                [
                    'group' => 'General',
                    'type' => 'datetime',
                    'label' => 'Time',
                    'input' => 'date',
                    'required' => false,
                    'sort_order' => 200,
                    'frontend' => 'Magento\Eav\Model\Entity\Attribute\Frontend\Datetime',
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
                'test_select',
                [
                    'group' => 'testingproduct',
                    'type' => 'varchar',
                    'label' => 'Test Select Grand',
                    'input' => 'select',
                    'required' => false,
                    'sort_order' => 2,
                    'source' => 'Magenest\Manufacturer\Model\Attribute\Source\Manufacturer',
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
}