<?php


namespace Learning\HelloForm\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Eav\Model\Entity\Attribute\SetFactory as AttributeSetFactory;
use Magento\Customer\Model\Customer;

class UpgradeData implements UpgradeDataInterface
{


    protected $customerSetupFactory;
    /**
     * @var AttributeSetFactory
     */
    protected $attributeSetFactory;

    public function __construct(
        CustomerSetupFactory $customerSetupFactory,
        AttributeSetFactory $attributeSetFactory
    ) {
        $this->customerSetupFactory = $customerSetupFactory;
        $this->attributeSetFactory = $attributeSetFactory;
    }

   public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
   {
       // TODO: Implement upgrade() method.
       if(version_compare($context->getVersion(), '2.0.7') < 0) {
           $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);
           $customerEntity = $customerSetup->getEavConfig()->getEntityType('customer');
           $attributeSetId = $customerEntity->getDefaultAttributeSetId();
            /* @var $attributeSet AttributeSet */
            $attributeSet = $this->attributeSetFactory->create();
            $attributeGroupId = $attributeSet->getDefaultGroupId($attributeSetId);

           $customerSetup->removeAttribute('customer', 'nick_name'); // xoa cai attribute old

           $customerSetup->addAttribute(Customer::ENTITY, 'nick_name', [
               'type' => 'varchar',
               'label' => 'Nick Name',
               'input' => 'text',
               'required' => false,
               'visible' => true,
               'user_defined' => true,
               'position' => 999,
               'system' => 0,
               'is_used_in_grid' => true,
           ]);

           $attribute = $customerSetup->getEavConfig()->getAttribute(Customer::ENTITY, 'nick_name')
               ->addData([
                   'attribute_set_id' => $attributeSetId,
                   'attribute_group_id' => $attributeGroupId,
                   'used_in_forms' => ['adminhtml_customer'],//you can use other forms also ['adminhtml_customer_address', 'customer_address_edit', 'customer_register_address']
               ]);

           $attribute->save();
       }
   }
}