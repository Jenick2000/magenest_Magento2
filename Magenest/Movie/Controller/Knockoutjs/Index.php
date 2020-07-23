<?php
namespace Magenest\Movie\Controller\Knockoutjs;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
class Index extends Action {

    /**
     * @var PageFactory
     */
    protected $pageFacoty;

    public function __construct(Context $context, PageFactory $pageFactory)
    {
        $this->pageFacoty = $pageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
       return $this->pageFacoty->create();
    }
}
