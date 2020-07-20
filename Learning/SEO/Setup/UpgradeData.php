<?php
namespace Learning\SEO\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class UpgradeData implements UpgradeDataInterface {
    protected  $resourceConfig;
    public function __construct(\Magento\Config\Model\ResourceModel\Config $resourceConfig)
    {
        $this->resourceConfig = $resourceConfig;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        // TODO: Implement upgrade() method.
        if(version_compare($context->getVersion(), '0.0.2') < 0) {
            $this->resourceConfig->saveConfig(
                'web/cookie/cookie_lifetime',
                '7200',
                \Magento\Config\Block\System\Config\Form::SCOPE_DEFAULT,
                0
            );
        }
    }

}