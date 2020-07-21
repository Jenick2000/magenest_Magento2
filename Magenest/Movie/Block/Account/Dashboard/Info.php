<?php
namespace Magenest\Movie\Block\Account\Dashboard;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Template;

class Info extends \Magento\Framework\View\Element\Template{

    /**
     * @var \Magento\Customer\Helper\Session\CurrentCustomer
     */
    protected $currentCustomer;

    public function __construct(Template\Context $context, \Magento\Customer\Helper\Session\CurrentCustomer $currentCustomer, array $data = [])
    {
        $this->currentCustomer = $currentCustomer;
        parent::__construct($context, $data);
    }

    public function getCustomer()
    {
        try {
            return $this->currentCustomer->getCustomer();
        } catch (NoSuchEntityException $e) {
            return null;
        }
    }

    public function getName() {
        return $this->getCustomer()->getLastname();
    }

    public function getPhone() {
         $telePhone = $this->getCustomer()->getAddresses()[0]->getTelephone();
         return $telePhone;
    }

    public function getUrlAvatar(){
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $mediaUrl = $objectManager->get('Magento\Store\Model\StoreManagerInterface')
                    ->getStore()
                    ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        $arrAttribute = $this->getCustomer()->getCustomAttributes();

        if(array_key_exists('logo_image', $arrAttribute)){
            $urlAvatar = $this->getCustomer()->getCustomAttributes()['logo_image']->getValue();
            return $mediaUrl.'customer'.$urlAvatar;
        }

        return '';

    }

    public function checkAvatar() {
        $arrAttribute = $this->getCustomer()->getCustomAttributes();
        if(!array_key_exists('logo_image', $arrAttribute)){
            return false;
        }
        return true;
    }


}
