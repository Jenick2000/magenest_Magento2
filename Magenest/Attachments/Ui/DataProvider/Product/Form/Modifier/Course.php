<?php
namespace Magenest\Attachments\Ui\DataProvider\Product\Form\Modifier;

use Magento\Backend\Model\UrlInterface;
use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier;
use Magento\Framework\Stdlib\ArrayManager;
use Magento\Ui\Component\Container;
use Magento\Ui\Component\Form\Element\DataType\Date;
use Magento\Ui\Component\Form\Element\DataType\Number;
use Magento\Ui\Component\Form\Element\DataType\Text;
use Magento\Ui\Component\Form\Element\Input;
use Magento\Ui\Component\Form\Field;

class Course extends AbstractModifier{

    /**
     * @var ArrayManager
     */
    private $arrayManager;

    /**
     * @var UrlInterface
     */
    private $url;

    public function __construct(ArrayManager $arrayManager, UrlInterface $url)
    {
        $this->arrayManager = $arrayManager;
        $this->url = $url;
    }

    public function modifyData(array $data)
    {
        return $data;
    }

    public function modifyMeta(array $meta)
    {
        $timeLinePath = $this->arrayManager->findPath('timeline', $meta, null, 'children');
        $meta = $this->arrayManager->merge(
            $timeLinePath,
            $meta,
            $this->fieldTimeLine()
        );
        $documentPath = $this->arrayManager->findPath('document', $meta, null, 'children');
        $meta = $this->arrayManager->merge(
            $documentPath,
            $meta,
            $this->fieldDocument()
        );

        return $meta;

    }

    /**
     * @return array
     */
    public function fieldDocument() {
        return [
            'arguments' => [
                'data' => [
                    'config' => [
                        'componentType' => 'field',
                        'component' => 'Magenest_Attachments/js/document',
                        'elementTmpl' => 'Magenest_Attachments/ui/form/element/document',
                        'ajaxUrl' => $this->url->getUrl('magenest/attachments/suggest'),
                        'emptyOptionsHtml' => __('Start typing to find documents'),
                        'dataType' => 'text',
                        'formElement' => 'input',
                        'label' => __('Document'),
                        'dataScope' => 'document',
                        'notice' => __('please enter at least 3 characters to show suggestion'),
                        'required' => true,
                        'visible' => '1',
                        'sortOrder' => 40
                    ],
                ],
            ]
        ];
    }

    /**
     * @return array
     */
    public function fieldTimeLine() {
        return [
            'arguments' => [
                'data' => [
                    'config' => [
                        'componentType' => 'dynamicRows',
                        'label' => __('Course Timeline'),
                        'renderDefaultRecord' => true,
                        'recordTemplate' => 'record',
                        'dataScope' => '',
                        'dndConfig' => [
                            'enabled' => false,
                        ],
                        'required' => true,
                        'sortOrder' => 30
                    ],
                ],
            ],
            'children' => [
                'record' => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'componentType' => Container::NAME,
                                'isTemplate' => true,
                                'is_collection' => true,
                                'component' => 'Magento_Ui/js/dynamic-rows/record',
                                'dataScope' => '',
                            ],
                        ],
                    ],
                    'children' => [
                        'time_from' => [
                            'arguments' => [
                                'data' => [
                                    'config' => [
                                        'formElement' => Date::NAME,
                                        'component'   => 'Magenest_Attachments/js/time',
                                        'componentType' => Field::NAME,
                                        'dataType' => Text::NAME,
                                        'label' => __('From'),
                                        'dataScope' => 'time_from',
                                        'sortOrder' => 30,
                                        'validation' => [
                                            'required-entry' => true,
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        'time_to' => [
                            'arguments' => [
                                'data' => [
                                    'config' => [
                                        'component'   => 'Magenest_Attachments/js/time',
                                        'componentType' => Field::NAME,
                                        'formElement' => Date::NAME,
                                        'dataType' => Text::NAME,
                                        'label' => __('To'),
                                        'enableLabel' => true,
                                        'dataScope' => 'time_to',
                                        'validation' => [
                                            'required-entry' => true,
                                        ],
                                        'sortOrder' => 40,
                                    ],
                                ],
                            ],
                        ],
                        'quantity' => [
                            'arguments' => [
                                'data' => [
                                    'config' => [
                                        'componentType' => Field::NAME,
                                        'formElement' => Input::NAME,
                                        'dataType' => Number::NAME,
                                        'label' => __('Quantity'),
                                        'enableLabel' => true,
                                        'dataScope' => 'quantity',
                                        'sortOrder' => 50,
                                        'validation' => [
                                            'required-entry' => true,
                                            'validate-greater-than-zero' => true,
                                            'validate-number' => true,
                                        ]
                                    ],
                                ],
                            ],
                        ],
                        'actionDelete' => [
                            'arguments' => [
                                'data' => [
                                    'config' => [
                                        'componentType' => 'actionDelete',
                                        'dataType' => Text::NAME,
                                        'label' => '',
                                        'sortOrder' => 100,
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];

    }
}
