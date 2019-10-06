<?php
namespace Project1\Test1\Controller\Adminhtml;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
abstract class Manufacturer extends Action
{
    protected $_coreRegistry;
    const ADMIN_RESOURCE = 'Project1_Test1::manufacturer';

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
        $resultPage->setActiveMenu('Project1_Test1::manufacturer')
            ->addBreadcrumb(__('CRUD'), __('CRUD'))
            ->addBreadcrumb(__('UI'), __('UI'));
        return $resultPage;
    }
}