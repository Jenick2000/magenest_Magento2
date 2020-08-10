<?php

namespace Magenest\JuniorLevel\Block\Adminhtml\Form\Field;

use Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\LocalizedException;
use Magenest\JuniorLevel\Block\Adminhtml\Form\Field\Color;
use Magenest\Movie\Block\System\Config\Button;

/**
 * Class Ranges
 */
class ColorOption extends AbstractFieldArray
{
    /**
     * @var Color
     */
    private $ColorRender;

    /**
     * Prepare rendering the new field by adding all the needed columns
     */
    protected function _prepareToRender()
    {
        $this->addColumn('name_color', ['label' => __('Color'), 'class' => 'required-entry']);
        $this->addColumn('color_code', [
            'label' => __('Color code'),
            'renderer' => $this->getColorRender()
        ]);
        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add');
    }


    public function getColorRender()
    {

        if (!$this->ColorRender) {
            $this->ColorRender = $this->getLayout()->createBlock(
                Color::class,
                '',
                ['data' => ['is_render_to_js_template' => true]]
            );
        }
        return $this->ColorRender;
    }
}
