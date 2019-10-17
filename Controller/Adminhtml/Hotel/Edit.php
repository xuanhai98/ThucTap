<?php
namespace Magenest3\XuanHai\Controller\Adminhtml\Hotel;
use Magenest3\XuanHai\Controller\Adminhtml\Hotel as HotelController;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magenest3\XuanHai\Model\HotelFactory;
class Edit extends HotelController
{

    protected $_resultPageFactory;

    protected $_hotelFactory;

    public function __construct(
        Context $context,
        Registry $coreRegistry,
        PageFactory $resultPageFactory,
        HotelFactory $hotelFactory
    )
    {
        $this->_resultPageFactory = $resultPageFactory;
        $this->_hotelFactory = $hotelFactory;
        parent::__construct($context, $coreRegistry);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('hotel_id');
        $model = $this->_hotelFactory->create();
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This Hotel Factory no longer exists.'));
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        $this->_coreRegistry->register('hotel', $model);
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('Magenest3_XuanHai::hotel');
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit Hotel') : __('New Hotel'),
            $id ? __('Edit Hotel') : __('New Hotel')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('HotelFactory'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? 'Edit Hotel' : __('New Hotel'));
        return $resultPage;
    }
}