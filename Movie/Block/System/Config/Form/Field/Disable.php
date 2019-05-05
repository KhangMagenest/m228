<?php
namespace Magenest\Movie\Block\System\Config\Form\Field;

use Magento\Framework\Data\Form\Element\AbstractElement;

class Disable extends \Magento\Config\Block\System\Config\Form\Field
{
    protected function _getElementHtml(AbstractElement $element)
    {
        $collection = $this->_objectManager->create('Magenest\Movie\Model\ResourceModel\Movie\Collection');
        $element->setDisabled('disabled');
        $element->setValue($collection->count());
        return $element->getElementHtml();

    }
}