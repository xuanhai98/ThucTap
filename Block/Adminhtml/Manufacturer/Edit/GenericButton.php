<?php
namespace Project1\Test1\Block\Adminhtml\Manufacturer\Edit;
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
        return $this->context->getRequest()->getParam('entity_id');
    }

    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}