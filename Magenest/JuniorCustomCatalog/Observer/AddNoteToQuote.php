<?php


namespace Magenest\JuniorCustomCatalog\Observer;


use Magento\Framework\App\RequestInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class AddNoteToQuote implements ObserverInterface
{

    /**
     * @var RequestInterface
     */
    protected $_request;

    public function __construct(RequestInterface $request)
    {
        $this->_request = $request;
    }

    public function execute(Observer $observer)
    {
        $cart = $observer->getData('cart');
        $note = $this->_request->getParam('note');
        $cart->getQuote()->setNote($note);
    }
}