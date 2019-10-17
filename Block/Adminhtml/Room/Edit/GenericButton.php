<?php
namespace Magenes\Cybergame\Block\Adminhtml\Room\Edit;
use Magento\Backend\Block\Widget\Context;
abstract class GenericButton
{
    protected $context;

    public function __construct(Context $context)
    {
        $this->context = $context;
    }

    public function getModelId()
    {
        return $this->context->getRequest()->getParam('id');
    }

    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}