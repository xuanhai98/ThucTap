<?php
namespace Magenest3\XuanHai\Block\Adminhtml\Hotel\Edit;
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
        return $this->context->getRequest()->getParam('hotel_id');
    }

    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}