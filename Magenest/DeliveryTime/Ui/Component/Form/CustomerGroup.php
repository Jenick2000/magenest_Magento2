<?php
namespace Magenest\DeliveryTime\Ui\Component\Form;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use Magento\Eav\Model\Entity\Attribute\Source\SourceInterface;
use Magento\Framework\Data\OptionSourceInterface;

class CustomerGroup extends AbstractSource implements SourceInterface, OptionSourceInterface {

    /**
     * Customer Group
     *
     * @var \Magento\Customer\Model\ResourceModel\Group\Collection
     */
    protected $_customerGroup;

    /**
     * @param \Magento\Customer\Model\ResourceModel\Group\Collection $customerGroup
     */
    public function __construct(
        \Magento\Customer\Model\ResourceModel\Group\Collection $customerGroup
    ) {
        $this->_customerGroup = $customerGroup;
    }

    public function getAllOptions()
    {
        $customerGroups = $this->_customerGroup->toOptionArray();
        array_unshift($customerGroups, array('value'=>'', 'label'=>'Any'));
        return $customerGroups;
    }
}
