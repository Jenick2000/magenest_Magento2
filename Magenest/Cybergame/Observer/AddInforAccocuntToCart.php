<?php

namespace Magenest\Cybergame\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class AddInforAccocuntToCart implements ObserverInterface
{
    /**
     * @var \Magento\Quote\Model\QuoteRepository
     */
    protected $quoteRepository;
    /**
     * @var \Magento\Framework\App\RequestInterface
     */
    protected $_request;

    public function __construct(
        \Magento\Quote\Model\QuoteRepository $quoteRepository,
        \Magento\Framework\App\RequestInterface $request
    )
    {
        $this->quoteRepository = $quoteRepository;
        $this->_request = $request;
    }

    public function execute(Observer $observer)
    {

        $items = $observer->getQuoteItem();
        $quoteId = $items->getData('quote_id');
        $account_name = $this->_request->getParam('account_name');

        $quote = $this->quoteRepository->get($quoteId); // Get quote by id

        foreach ($quote->getData('items') as $item) {
            $item->setData('description', $account_name);
        }

        $this->quoteRepository->save($quote); // Save quote
    }
}