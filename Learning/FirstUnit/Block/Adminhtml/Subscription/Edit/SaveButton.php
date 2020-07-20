<?php
 namespace Learning\FirstUnit\Block\Adminhtml\Subscription\Edit;


 use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

 class SaveButton  implements  ButtonProviderInterface {

     public function getButtonData()
     {
         return [
             'label' => __('Save Subscription'),
             'class' => 'save primary',
             'data_attribute' => [
                 'mage-init' => ['button' => ['event' => 'save']],
                 'form-role' => 'save',
             ],
             'sort_order' => 10,
//             'action' => 'helloworld/subscription/save'
         ];
     }


 }