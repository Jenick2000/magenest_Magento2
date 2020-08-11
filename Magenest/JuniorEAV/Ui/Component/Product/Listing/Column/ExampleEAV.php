<?php

namespace Magenest\JuniorEAV\Ui\Component\Product\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponentInterface;
use Magento\Ui\Component\Listing\Columns\Column;

class ExampleEAV extends Column
{
    /**
     * @var \Magento\Backend\Model\Auth\Session
     */
    protected $authSession;

    public function __construct(ContextInterface $context, \Magento\Backend\Model\Auth\Session $authSession, UiComponentFactory $uiComponentFactory, array $components = [], array $data = [])
    {
        $this->authSession = $authSession;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepare()
    {
        parent::prepare();

        $currentUser = $this->authSession->getUser();
        $firstName = $currentUser->getData('firstname');
        $fc = str_split($firstName, 1);
        if ($fc[0] === 'j' || $fc[0] === 'J') {
            $this->_data['config']['componentDisabled'] = false;
        }
    }

}