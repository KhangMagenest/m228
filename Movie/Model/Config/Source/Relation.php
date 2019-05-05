<?php
namespace Magenest\Movie\Model\Config\Source;
class Relation implements \Magento\Framework\Option\ArrayInterface
{
    public function toOptionArray()
    {
        return [
            [
                'value' => null,
                'label' => __('--Please Select--')
            ],
            [
                'value' => 1,
                'label' => __('show')
            ],
            [
                'value' => 2,
                'label' => __('not-show')
            ],
        ];
    }
}