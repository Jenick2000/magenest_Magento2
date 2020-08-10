<?php

namespace Magenest\JuniorLevel\Block\Adminhtml\Form\Field;


use Magento\Backend\Block\Template\Context;
use Magento\Framework\View\Element\Html\Select;

class Color extends Select
{

    public function __construct(
        Context $context,
        array $data = []
    )
    {
        parent::__construct($context, $data);
    }


    protected function _toHtml()
    {
        $html = '<input type="text" name="' . $this->getInputName() . '" id="' . $this->getInputId() . '" value="">';
        $id = $this->getInputId();
        $value = '';
        $html .= ' <script type="text/javascript">
                require(["jquery", "jquery/colorpicker/js/colorpicker"], function ($) {
                    $(document).ready(function () {
                        var $el = $("#' . $id . '");
                        let value = $el.val();
                        $el.css("backgroundColor", value);
            
                        // Attach the color picker
                        $el.ColorPicker({
                            color: "' . $value . '",
                            onChange: function (hsb, hex, rgb) {
                                console.log(value);
                                $el.css("backgroundColor", "#" + hex).val("#" + hex);
                                $el.val("#" + hex)
                            }
                    });
                });
    });
</script>';
        return $html;
    }


}