<?php
namespace Magenests\XuanHai\Controller\Adminhtml;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
abstract class Vendor extends Action
{
    protected $_coreRegistry;
    const ADMIN_RESOURCE = 'Magenests_XuanHai::vendor';

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
        $resultPage->setActiveMenu('Magenests_XuanHai::vendor')
            ->addBreadcrumb(__('CRUD'), __('CRUD'))
            ->addBreadcrumb(__('UI'), __('UI'));
        return $resultPage;
    }
}