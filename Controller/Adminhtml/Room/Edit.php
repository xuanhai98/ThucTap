<?php
namespace Magenes\Cybergame\Controller\Adminhtml\Room;
use Magenes\Cybergame\Controller\Adminhtml\Room as RoomController;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magenes\Cybergame\Model\RoomFactory;
class Edit extends RoomController
{

    protected $_resultPageFactory;

    protected $_roomFactory;

    public function __construct(
        Context $context,
        Registry $coreRegistry,
        PageFactory $resultPageFactory,
        RoomFactory $roomFactory
    )
    {
        $this->_resultPageFactory = $resultPageFactory;
        $this->_roomFactory = $roomFactory;
        parent::__construct($context, $coreRegistry);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $model = $this->_roomFactory->create();
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This room Factory no longer exists.'));
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        $this->_coreRegistry->register('room', $model);
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('Magenes_Cybergame::room');
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit Room') : __('New Room'),
            $id ? __('Edit Room') : __('New Room')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('RoomFactory'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? 'Edit Room' : __('New Room'));
        return $resultPage;
    }
}