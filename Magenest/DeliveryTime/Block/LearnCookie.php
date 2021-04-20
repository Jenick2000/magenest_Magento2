<?php
namespace Magenest\DeliveryTime\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\Stdlib\Cookie\CookieMetadataFactory;
use Magento\Framework\Session\SessionManagerInterface;

class LearnCookie extends Template {
    const COOKIE_DURATION = 86400; // One day (86400 seconds)
    protected $_cookieManager;
    protected $cookieMetadataFactory;
    protected $sessionManager;

    public function __construct(
        Template\Context $context,
        \Magento\Framework\Stdlib\CookieManagerInterface $cookieManager,
        CookieMetadataFactory $cookieMetadataFactory,
        SessionManagerInterface $sessionManager,
        array $data = [])
    {
        $this->_cookieManager = $cookieManager;
        $this->cookieMetadataFactory = $cookieMetadataFactory;
        $this->sessionManager = $sessionManager;
        parent::__construct($context, $data);
    }

    /**
     * get cookie by name
     */
    public function getCookie($cookieName) {
        return $this->_cookieManager->getCookie($cookieName);

    }

    /**
     * Public cookies can be accessed by JS. HttpOnly will be set to false by default for these cookies
     */
    public function setPublicCookie($cookieName, $value) {
        $metadata = $this->cookieMetadataFactory
            ->createPublicCookieMetadata()
            ->setDuration(86400) // Cookie will expire after one day (86400 seconds)
            ->setSecure(true) //the cookie is only available under HTTPS
            ->setPath('/subfolder')// The cookie will be available to all pages and subdirectories within the /subfolder path
            ->setHttpOnly(false); // cookies can be accessed by JS if false

        $this->_cookieManager->setPublicCookie(
            $cookieName,
            $value,
            $metadata
        );
    }

    /**
     * Sensitive cookies cannot be accessed by JS. HttpOnly will always be set to true for these cookies.
     */
    public function setSensitiveCookie($cookieName, $value) {
        $metadata = $this->cookieMetadataFactory
            ->createSensitiveCookieMetadata()
            ->setPath('/')// for global
            ->setDomain('.example.com');// cookie will be available for www.example.com, example.com and will not be available for anotherexample.com

        $this->_cookieManager->setSensitiveCookie(
            $cookieName,
            $value,
            $metadata
        );
    }
}