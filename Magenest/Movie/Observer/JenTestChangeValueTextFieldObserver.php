<?php

namespace Magenest\Movie\Observer;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\Config\Storage\WriterInterface;

class JenTestChangeValueTextFieldObserver implements ObserverInterface
{

    /**
     * @var WriteInterface
     */
    protected $_write;
    /**
     * @var ScopeConfigInterface
     */
    protected $_scopeConfig;
    /**
     * @var \Magento\Framework\App\Cache\TypeListInterface
     */
    protected $_cacheTypeList;

    public function __construct(WriterInterface $write, ScopeConfigInterface $scopeConfig, \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList )
    {
        $this->_write = $write;
        $this->_scopeConfig = $scopeConfig;
        $this->_cacheTypeList = $cacheTypeList;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $path = 'Movie/general/text_field';
        $value = 'Pong';
        $text_field = $this->_scopeConfig->getValue($path, $scopeType = ScopeConfigInterface::SCOPE_TYPE_DEFAULT, $scopeCode = null);
        if( strtolower($text_field) == 'ping'){
            $this->_write->save($path, $value, $scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT, $scopeId = 0);
        }
        $this->clearCache();

    }

      public function clearCache() {
          $this->_cacheTypeList->cleanType(\Magento\Framework\App\Cache\Type\Config::TYPE_IDENTIFIER);
          $this->_cacheTypeList->cleanType(\Magento\PageCache\Model\Cache\Type::TYPE_IDENTIFIER);
      }
}