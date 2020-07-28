<?php

namespace Magenest\Manufacturer\Controller\Test;

use Magento\Framework\App\Action\Action;

class Create extends Action
{

    public function execute()
    {
        $data = $this->getRequest()->getPost();
        var_dump($data);
    }
}