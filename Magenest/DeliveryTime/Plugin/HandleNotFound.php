<?php
namespace Magenest\DeliveryTime\Plugin;

use Magento\Framework\App\ActionFactory;
use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Message\MessageInterface;
use Magento\Framework\Stdlib\Cookie\CookieMetadataFactory;
use Magento\Framework\Translate\Inline\ParserInterface;
use Magento\Framework\Translate\InlineInterface;

class HandleNotFound {

    const MESSAGES_COOKIES_NAME = 'mage-messages';
    protected $actionFactory;
    protected $categoryCollectionFactory;
    protected $_response;
    protected $messageManager;
    protected $searchCollection;
    protected $productCollectionFactory;
    private $cookieManager;
    private $cookieMetadataFactory;
    protected $serializer;
    protected $interpretationStrategy;
    /**
     * @var InlineInterface|mixed
     */
    protected $inlineTranslate;

    public function __construct(
        ActionFactory $actionFactory,
        CollectionFactory $collectionFactory,
        \Magento\Framework\App\ResponseInterface $response,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        \Magento\Search\Model\ResourceModel\Query\CollectionFactory $searchCollection,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Magento\Framework\Stdlib\CookieManagerInterface $cookieManager,
        CookieMetadataFactory $cookieMetadataFactory,
        \Magento\Framework\Serialize\Serializer\Json $serializer,
        \Magento\Framework\View\Element\Message\InterpretationStrategyInterface $interpretationStrategy,
        InlineInterface $inlineTranslate = null
    )
    {
        $this->actionFactory = $actionFactory;
        $this->categoryCollectionFactory = $collectionFactory;
        $this->_response = $response;
        $this->messageManager = $messageManager;
        $this->searchCollection = $searchCollection;
        $this->productCollectionFactory = $productCollectionFactory;
        $this->cookieManager = $cookieManager;
        $this->cookieMetadataFactory = $cookieMetadataFactory;
        $this->serializer = $serializer;
        $this->interpretationStrategy = $interpretationStrategy;
        $this->inlineTranslate = $inlineTranslate ?: ObjectManager::getInstance()->get(InlineInterface::class);
    }

    public function aroundMatch(\Magento\Framework\App\Router\DefaultRouter $subject, callable $process, $request) {

        $result = $this->checkRequest($request);

        if($result) {
            $urlRedirect = $result;
            if(is_array($result)) {
                $urlRedirect = $result['category']->getUrl();
            }
            $this->_response->setRedirect($urlRedirect);
            $this->messageManager->addNoticeMessage(__('The path %1 does not exist. Are you looking for %2?', [$request->getPathInfo(), $result['category']->getName()]));
            $this->setCookie($this->getMessages());
            return $this->actionFactory->create(\Magento\Framework\App\Action\Redirect::class);
        }

        return $process($request);
    }

    /**
     * @param $request
     * @return string|array
     */
    public function checkRequest($request) {

        $keywords = preg_split("/[\/_]+/", $request->getPathInfo());
        foreach ($keywords as $keyword) {
            if(!empty($keyword)) {
                $category = $this->categoryCollectionFactory->create()
                    ->addAttributeToSelect('*')
                    ->addAttributeToFilter('name', ['like' => '%'.$keyword.'%'])
                    ->getFirstItem();
                if($category->getId())
                    return ['category' => $category, 'isCategory' => true];

                $searchTerm = $this->searchCollection->create()
                    ->addFieldToFilter('query_text', $keyword)
                    ->getFirstItem();
                if($searchTerm->getId())
                    return '/catalogsearch/result/?q='. $searchTerm->getQueryText();

                if(strlen($keyword) >= 3) {
                    $product = $this->productCollectionFactory->create()
                        ->addAttributeToSelect('*')
                        ->addAttributeToFilter('name', ['like' => '%'.$keyword.'%'])
                        ->getFirstItem();
                    if($product->getId())
                        return $product->getUrl();
                }
            }
        }
        return '';
    }
    /**
     * Set 'mage-messages' cookie with 'messages' array
     *
     * Checks the $messages argument. If $messages is not an empty array, then
     * sets 'mage-messages' public cookie:
     *
     *   Cookie Name: 'mage-messages';
     *   Cookie Duration: 1 year;
     *   Cookie Path: /;
     *   Cookie HTTP Only flag: FALSE. Cookie can be accessed by client-side APIs.
     *
     * The 'messages' list has format:
     * [
     *   [
     *     'type' => 'type_value',
     *     'text' => 'cookie_value',
     *   ],
     * ]
     *
     * @param array $messages List of Magento messages that must be set as 'mage-messages' cookie.
     * @return void
     */
    private function setCookie(array $messages)
    {
        if (!empty($messages)) {

            if ($this->inlineTranslate->isAllowed()) {
                foreach ($messages as &$message) {
                    $message['text'] = $this->convertMessageText($message['text']);
                }
            }

            $publicCookieMetadata = $this->cookieMetadataFactory->createPublicCookieMetadata();
            $publicCookieMetadata->setDurationOneYear();
            $publicCookieMetadata->setPath('/');
            $publicCookieMetadata->setHttpOnly(false);

            $this->cookieManager->setPublicCookie(
                self::MESSAGES_COOKIES_NAME,
                $this->serializer->serialize($messages),
                $publicCookieMetadata
            );
        }
    }
    /**
     * Replace wrapping translation with html body.
     *
     * @param string $text
     * @return string
     */
    private function convertMessageText(string $text): string
    {
        if (preg_match('#' . ParserInterface::REGEXP_TOKEN . '#', $text, $matches)) {
            $text = $matches[1];
        }

        return $text;
    }

    protected function getMessages()
    {
        $messages = $this->getCookiesMessages();
        /** @var MessageInterface $message */
        foreach ($this->messageManager->getMessages(true)->getItems() as $message) {
            $messages[] = [
                'type' => $message->getType(),
                'text' => $this->interpretationStrategy->interpret($message),
            ];
        }
        return $messages;
    }

    /**
     * Return messages stored in cookies
     *
     * @return array
     */
    protected function getCookiesMessages()
    {
        $messages = $this->cookieManager->getCookie(self::MESSAGES_COOKIES_NAME);
        if (!$messages) {
            return [];
        }
        $messages = $this->serializer->unserialize($messages);
        if (!is_array($messages)) {
            $messages = [];
        }
        return $messages;
    }
}