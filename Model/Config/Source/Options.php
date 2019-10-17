<?php
namespace Project1\Test1\Model\Config\Source;
class Options implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Options for Type
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' =>  'Vietnam', 'label' => __('Vietnam')],
            ['value' =>  'Us', 'label' => __('Us')],
            ['value' =>  'China', 'label' => __('China')]
        ];
    }}
