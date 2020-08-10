<?php

namespace Magenest\Movie\Block\Adminhtml\Form\Field;

use Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\LocalizedException;
use Magenest\Movie\Block\Adminhtml\Form\Field\TaxColumn;
use Magenest\Movie\Block\Adminhtml\Form\Field\CustomerGroupColumn;

class ClockType extends AbstractFieldArray
{
    /**
     * @var TaxColumn
     */
    private $taxRenderer;

    /**
     * @var CustomerGroupColumn
     */
    private $customerGroupRenderer;

    /**
     * Prepare rendering the new field by adding all the needed columns
     */
    protected function _prepareToRender()
    {
        $this->addColumn('customer_group', [
            'label' => __('Customer Group'),
            'renderer' => $this->getCustomerGroupRender()
        ]);
        $this->addColumn('tax', [
            'label' => __('Tax'),
            'renderer' => $this->getTaxRenderer()
        ]);
        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add');
    }

    /**
     * Prepare existing row data object
     *
     * @param DataObject $row
     * @throws LocalizedException
     */
    protected function _prepareArrayRow(DataObject $row): void
    {
        $options = [];

        $tax = $row->getData('tax');
        $cusGro = $row->getData('customer_group');
        if ($tax !== null && $cusGro !== null) {
            $options['option_' . $this->getTaxRenderer()->calcOptionHash($tax)] = 'selected="selected"';
            $options['option_' . $this->getCustomerGroupRender()->calcOptionHash($cusGro)] = 'selected="selected"';
        }

        $row->setData('option_extra_attrs', $options);
    }

    /**
     * @return TaxColumn
     * @throws LocalizedException
     */
    private function getTaxRenderer()
    {
        if (!$this->taxRenderer) {
            $this->taxRenderer = $this->getLayout()->createBlock(
                TaxColumn::class,
                '',
                ['data' => ['is_render_to_js_template' => true]]
            );
        }
        return $this->taxRenderer;
    }

    public function getCustomerGroupRender()
    {

        if (!$this->customerGroupRenderer) {
            $this->customerGroupRenderer = $this->getLayout()->createBlock(
                CustomerGroupColumn::class,
                '',
                ['data' => ['is_render_to_js_template' => true]]
            );
        }
        return $this->customerGroupRenderer;
    }
}