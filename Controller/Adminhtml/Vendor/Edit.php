<?php
namespace Magenests\XuanHai\Controller\Adminhtml\Vendor;
use Magenests\XuanHai\Controller\Adminhtml\Vendor as VendorController;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magenests\XuanHai\Model\VendorFactory;
class Edit extends VendorController
{

    protected $_resultPageFactory;

    protected $_vendorFactory;

    public function __construct(
        Context $context,
        Registry $coreRegistry,
        PageFactory $resultPageFactory,
        VendorFactory $vendorFactory
    )
    {
        $this->_resultPageFactory = $resultPageFactory;
        $this->_vendorFactory = $vendorFactory;
        parent::__construct($context, $coreRegistry);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $model = $this->_vendorFactory->create();
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This Vendor Factory no longer exists.'));
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        $this->_coreRegistry->register('vendor', $model);
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('Magenests_XuanHai::vendor');
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit Vendor') : __('New Vendor'),
            $id ? __('Edit Vendor') : __('New Vendor')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('VendorFactory'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? 'Edit Vendor' : __('New Vendor'));
        return $resultPage;
    }
}