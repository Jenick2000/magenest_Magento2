<?php

declare(strict_types=1);

namespace Magenest\Movie\Block\Adminhtml\Form\Field;

use Magento\Framework\View\Element\Html\Select;

class TaxColumn extends Select
{
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
        return [
            ['label' => 'Type 1', 'value' => '1'],
            ['label' => 'Type 2', 'value' => '2'],
            ['label' => 'Type 3', 'value' => '3'],
        ];
    }
}
