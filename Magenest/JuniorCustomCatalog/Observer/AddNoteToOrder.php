<?php

namespace Magenest\JuniorCustomCatalog\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class AddNoteToOrder implements ObserverInterface
{
    /**
     * @var \Magento\Quote\Model\QuoteRepository
     */
    protected $quoteRepository;

    public function __construct(
        \Magento\Quote\Model\QuoteRepository $quoteRepository
    )
    {
        $this->quoteRepository = $quoteRepository;
    }

    public function execute(Observer $observer)
    {
        $order = $observer->getData('order');
        $quote_id = $order->getQuoteId();
        $quote = $this->quoteRepository->get($quote_id);
        $note = $quote->getData('note');
        $order->setNote($note);
    }
}