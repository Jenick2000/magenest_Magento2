<?php

namespace Learning\FirstUnit\Setup;


use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;



class UpgradeData implements UpgradeDataInterface {

    protected $categorySetupFactory;
    public function __construct(\Magento\Catalog\Setup\CategorySetupFactory $categorySetupFactory) {
        $this->categorySetupFactory = $categorySetupFactory;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        if(version_compare($context->getVersion(), '1.0.4') < 0) {
            $categorySetup = $this->categorySetupFactory->create(['setup' => $setup]);
                $entityTypeId = $categorySetup->getEntityTypeId(\Magento\Catalog\Model\Product::ENTITY);

            //$categorySetup->removeAttribute($entityTypeId, 'sample_attribute');
            $categorySetup->removeAttribute($entityTypeId, 'size');


//            $categorySetup->addAttribute($entityTypeId,
//                'sample_attribute', array(
//                    'type' => 'text',
//                    'backend' => '',
//                    'frontend' => '',
//                    'label' => 'Sample Atrribute',
//                    'input' => 'text',
//                    'class' => '',
//                    'source' => '',
//                    'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
//                    'visible' => true,
//                    'required' => false,
//                    'user_defined' => false,
//                    'default' => '',
//                    'searchable' => false,
//                    'filterable' => false,
//                    'comparable' => false,
//                    'visible_on_front' => false,
//                    'used_in_product_listing' => true,
//                    'unique' => false,
//                    'apply_to' => ''
//                ));
        }
    }
}