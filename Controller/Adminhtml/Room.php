<?php
namespace Magenes\Cybergame\Controller\Adminhtml;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
abstract class Room extends Action
{
    protected $_coreRegistry;
    const ADMIN_RESOURCE = 'Magenes_Cybergame::room';

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
        $resultPage->setActiveMenu('Magenes_Cybergame::room')
            ->addBreadcrumb(__('CRUD'), __('CRUD'))
            ->addBreadcrumb(__('UI'), __('UI'));
        return $resultPage;
    }
}