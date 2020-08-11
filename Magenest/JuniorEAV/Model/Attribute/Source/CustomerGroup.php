<?php
namespace Magenest\JuniorEAV\Model\Attribute\Source;

class CustomerGroup extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource{

    /**
     * @var \Magento\Customer\Model\ResourceModel\Group\Collection
     */
    protected $_customerGroup;

    public function __construct(
        \Magento\Customer\Model\ResourceModel\Group\Collection $customerGroup
    )
    {
        $this->_customerGroup = $customerGroup;
    }
    /**
     * Get customer groups
     *
     * @return array
     */
    public function getCustomerGroups() {
        $customerGroups = $this->_customerGroup->toOptionArray();
        array_unshift($customerGroups, array('value'=>'', 'label'=>'Any'));
        return $customerGroups;
    }

    public function getAllOptions()
    {
        return $this->getCustomerGroups();
    }
}