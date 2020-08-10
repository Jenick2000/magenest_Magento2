<?php

namespace Magenest\Movie\Block\Adminhtml\Form\Field;

use Magento\Framework\View\Element\Html\Select;

class CustomerGroupColumn extends Select
{

    /**
     * @var \Magento\Customer\Model\ResourceModel\Group\Collection
     */
    protected $_customerGroup;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Customer\Model\ResourceModel\Group\Collection $customerGroup,
        array $data = []
    )
    {
        $this->_customerGroup = $customerGroup;
        parent::__construct($context, $data);
    }

    /**
     * Set "name" for <select> element
     *
     * @param string $value
     * @return $this
     */
    public function setInputName($value)
    {
        return $this->setName($value);
    }

    /**
     * Set "id" for <select> element
     *
     * @param $value
     * @return $this
     */
    public function setInputId($value)
    {
        return $this->setId($value);
    }

    /**
     * Render block HTML
     *
     * @return string
     */
    public function _toHtml(): string
    {
        if (!$this->getOptions()) {
            $this->setOptions($this->getSourceOptions());
        }
        return parent::_toHtml();
    }

    private function getSourceOptions(): array
    {

        return $this->getCustomerGroups();

    }

    /**
     * Get customer groups
     *
     * @return array
     */
    public function getCustomerGroups()
    {
        $customerGroups = $this->_customerGroup->toOptionArray();
        array_unshift($customerGroups, array('value' => '', 'label' => 'Any'));
        return $customerGroups;
    }
}