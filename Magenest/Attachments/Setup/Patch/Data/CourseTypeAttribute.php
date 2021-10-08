<?php

namespace Magenest\Attachments\Setup\Patch\Data;

use Magenest\Attachments\Model\Product\Type\Course;
use Magento\Catalog\Model\Product;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class CourseTypeAttribute implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $setup;

    /**
     * EAV setup factory
     *
     * @var EavSetupFactory
     */
    protected $eavSetupFactory;

    /**
     * Init
     *
     * @param ModuleDataSetupInterface $setup
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(
        ModuleDataSetupInterface $setup,
        EavSetupFactory $eavSetupFactory
    ) {
        $this->setup = $setup;
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * @return Course|void
     */
    public function apply()
    {
        /** @var EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->setup]);

        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'timeline',
            [
                'group' => 'Product Details',
                'type' => 'text',
                'sort_order' => 50,
                'label' => 'Course Timeline',
                'input' => 'text',
                'backend' => \Magenest\Attachments\Model\Product\Attribute\Backend\TimeLine::class,
                'frontend' => null,
                'is_global' => 1,
                'visible' => true,
                'required' => false,
                'user_defined' => false,
                'searchable' => false,
                'filterable' => false,
                'comparable' => false,
                'visible_on_front' => false,
                'used_in_product_listing' => true,
                'unique' => false,
                'apply_to'=> Course::TYPE_CODE
            ]
        );

        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'document',
            [
                'group' => 'Product Details',
                'type' => 'text',
                'sort_order' => 52,
                'label' => 'Document',
                'input' => 'text',
                'backend' => \Magenest\Attachments\Model\Product\Attribute\Backend\Document::class,
                'frontend' => null,
                'global' => 1,
                'visible' => true,
                'required' => false,
                'user_defined' => false,
                'searchable' => false,
                'filterable' => false,
                'comparable' => false,
                'visible_on_front' => false,
                'used_in_product_listing' => true,
                'unique' => false,
                'apply_to'=> Course::TYPE_CODE
            ]
        );

        $fieldList = [
            'price',
            'special_price',
            'special_from_date',
            'special_to_date',
            'minimal_price',
            'cost',
            'tier_price',
        ];

        foreach ($fieldList as $field) {
            $applyTo = explode(
                ',',
                $eavSetup->getAttribute(Product::ENTITY, $field, 'apply_to')
            );
            if (!in_array(Course::TYPE_CODE, $applyTo)) {
                $applyTo[] = Course::TYPE_CODE;
                $eavSetup->updateAttribute(
                    Product::ENTITY,
                    $field,
                    'apply_to',
                    implode(',', $applyTo)
                );
            }
        }


    }

    /**
     * @return string[]|void
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * @return string[]|void
     */
    public function getAliases()
    {
        return [];
    }
}
