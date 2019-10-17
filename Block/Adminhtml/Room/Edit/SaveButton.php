<?php
namespace Magenes\Cybergame\Block\Adminhtml\Room\Edit;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
class SaveButton extends GenericButton implements ButtonProviderInterface
{

    public function getButtonData()
    {
        return [
            'label' => __('Save Room'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => ['button' => ['event' => 'save']],
                'form-role' => 'save',
            ],
            'sort_order' => 90,
        ];
    }
}