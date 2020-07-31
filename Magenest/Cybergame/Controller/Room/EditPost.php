<?php

namespace Magenest\Cybergame\Controller\Room;

use Magento\Framework\App\Action\Action;
use Magenest\Cybergame\Model\RoomExtraOptionFactory;
use Magento\Framework\App\Action\Context;

class EditPost extends Action
{
    /**
     * @var RoomExtraOptionFactory
     */
    protected $roomExtraOptionFactory;

    public function __construct(Context $context, RoomExtraOptionFactory $roomExtraOptionFactory)
    {
        $this->roomExtraOptionFactory = $roomExtraOptionFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->getRequest()->getPost();

        $roomExtra = $this->roomExtraOptionFactory->create();
        if ($roomExtra->load($data['room_id'])->getId()) {
            $roomExtra->setDrinkPrice($data['drink_price']);
            $roomExtra->setFoodPrice($data['food_price']);
            $roomExtra->setNumberPc($data['number_pc']);
            $roomExtra->setAddress($data['address']);
            $roomExtra->save();
            $this->messageManager->addSuccessMessage('You Edited Room Option');
            $this->_redirect('*/*/update');
        }
    }
}