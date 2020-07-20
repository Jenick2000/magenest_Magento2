<?php
namespace  Learning\FirstUnit\Block\Adminhtml\Subscription;

use Magento\Backend\Block\Widget\Grid as WidgetGrid;

class Grid extends \Magento\Backend\Block\Widget\Grid\Extended {

    protected  $_subscriptionCollection;
    public function __construct(\Magento\Backend\Block\Template\Context $context, \Magento\Backend\Helper\Data $backendHelper,
                                \Learning\FirstUnit\Model\ResourceModel\Subscription\Collection $subscriptionCollection, array $data = [])
    {
        $this->_subscriptionCollection = $subscriptionCollection;
        parent::__construct($context, $backendHelper, $data);
        $this->setEmptyText('Not fould any Subscription');
    }

    protected function _prepareCollection() {

        $this->setCollection($this->_subscriptionCollection);

        return parent::_prepareCollection();
    }
    protected function _prepareColumns()
    {
        try {
            $this->addColumn('subscription_id',
                [
                    'header'=> __('ID'),
                    'index' => 'subscription_id'
                ]);
            $this->addColumn('firstname',
                [
                   'header' => __('First Name'),
                   'index' =>'firstname'
                ]);
            $this->addColumn('firstname',
                [
                   'header' => __('First Name'),
                   'index' =>'firstname'
                ]);
            $this->addColumn('lastname',
                [
                   'header' => __('Last Name'),
                   'index' =>'lastname'
                ]);
            $this->addColumn('email',
                [
                   'header' => __('Email'),
                   'index' =>'email'
                ]);
            $this->addColumn('status',
                [
                   'header' => __('Status'),
                   'index' =>'status',
                    'frame_callback' => [$this, 'decorateStatus']
                ]);


        } catch (\Exception $e) {
        }
        return $this;
    }

    public function decorateStatus($value) {
        $class = '';
        switch ($value) {
            case 'pending':
                $class = 'grid-severity-minor';
                break;
            case  'complete':
                $class = 'grid-severity-notice';
                break;
            case 'canceled':
            default:
                $class = 'grid-severity-critical';
                break;
        }

        return '<span class="'.$class.'"></span> <span> '.$value.'</span>';
    }
}