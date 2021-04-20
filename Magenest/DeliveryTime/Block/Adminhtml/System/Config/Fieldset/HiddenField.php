<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magenest\DeliveryTime\Block\Adminhtml\System\Config\Fieldset;

use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Config\Block\System\Config\Form\Field;

/**
 * Class Hint adds "Configuration Details" link to payment configuration.
 * `<comment>` node must be defined in `<group>` node and contain some link.
 */
class HiddenField extends Field
{

    /**
     * @param AbstractElement $element
     * @return string
     */
    public function render(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        return '';
    }


}
