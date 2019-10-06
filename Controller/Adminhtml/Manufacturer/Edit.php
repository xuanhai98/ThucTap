<?php
namespace Project1\Test1\Controller\Adminhtml\Manufacturer;
use Project1\Test1\Controller\Adminhtml\Manufacturer as ManufacturerController;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Project1\Test1\Model\ManufacturerFactory;
class Edit extends ManufacturerController
{

    protected $_resultPageFactory;

    protected $_manufacturerFactory;

    public function __construct(
        Context $context,
        Registry $coreRegistry,
        PageFactory $resultPageFactory,
        ManufacturerFactory $manufacturerFactory
    )
    {
        $this->_resultPageFactory = $resultPageFactory;
        $this->_manufacturerFactory = $manufacturerFactory;
        parent::__construct($context, $coreRegistry);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('entity_id');
        $model = $this->_manufacturerFactory->create();
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This Manufacturer no longer exists.'));
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        $this->_coreRegistry->register('manufacturer', $model);
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('Project1_Test1::manufacturer');
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit Manufacturer') : __('New Manufacturer'),
            $id ? __('Edit Manufacturer') : __('New Manufacturer')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Manufacturer'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? 'Edit Manufacturer ' : __('New Manufacturer'));
        return $resultPage;
    }
}