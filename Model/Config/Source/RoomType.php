<?php

namespace Magenest3\XuanHai\Model\Config\Source;

class RoomType extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{

    public function getAllOptions()
    {
        if ($this->_options === null) {
            $this->_options = [
                ['value' => 'Single', 'label' => __('single')],
                ['value' => 'Double', 'label' => __('double')],
                ['value' => 'Triple', 'label' => __('triple')]
            ];
        }
        return $this->_options;
    }

    public function getOptionValue($value)
    {
        foreach ($this->getAllOptions() as $option) {
            if ($option['value'] == $value) {
                return $option['label'];
            }
        }
        return false;
    }
}