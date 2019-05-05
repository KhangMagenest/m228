<?php

namespace Magenest\Movie\Controller\Index;

class Test extends \Magento\Framework\App\Action\Action
{


    public function execute()
    {
        $collection = $this->_objectManager->create('Magenest\Movie\Model\ResourceModel\Movie\Collection');
        $output = '';
        echo $collection->getSelect()->__toString();
//        foreach ($collection as $product) {
//            $output .= \Zend_Debug::dump($product->debug(), null,
//                false);
//        }
//
//        //$this->getResponse()->setBody($output);
    }
}