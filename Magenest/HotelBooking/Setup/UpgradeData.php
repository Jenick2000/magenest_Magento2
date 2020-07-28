<?php

namespace Magenest\HotelBooking\Setup;

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
        if (version_compare($context->getVersion(), '1.0.1') < 0) {
            $eavSetup = $this->eavSetupFactory->create();
            //$eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'manufacturer_id');
            $eavSetup->addAttribute(
                \Magento\Catalog\Model\Product::ENTITY,
                'hotel_id',
                [
                    'group' => 'General',
                    'type' => 'int',
                    'label' => 'Hotel',
                    'input' => 'select',
                    'required' => false,
                    'sort_order' => 50,
                    'source' => 'Magenest\HotelBooking\Model\Attribute\Source\Hotel',
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
                'room_type',
                [
                    'group' => 'General',
                    'type' => 'varchar',
                    'label' => 'Room Type',
                    'input' => 'select',
                    'required' => false,
                    'sort_order' => 50,
                    'source' => 'Magenest\HotelBooking\Model\Attribute\Source\RoomType',
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