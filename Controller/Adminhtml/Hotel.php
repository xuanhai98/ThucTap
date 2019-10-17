<?php
namespace Magenest3\XuanHai\Controller\Adminhtml;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
abstract class Hotel extends Action
{
    protected $_coreRegistry;
    const ADMIN_RESOURCE = 'Magenest3_XuanHai::hotel';

    public function __construct(
        Context $context,
        Registry $coreRegistry
    )
    {
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context);
    }

    public function initPage($resultPage)
    {
        $resultPage->setActiveMenu('Magenest3_XuanHai::hotel')
            ->addBreadcrumb(__('CRUD'), __('CRUD'))
            ->addBreadcrumb(__('UI'), __('UI'));
        return $resultPage;
    }
}