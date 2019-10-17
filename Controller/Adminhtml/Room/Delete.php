<?php
namespace Magenes\Cybergame\Controller\Adminhtml\Room;

use Magenes\Cybergame\Controller\Adminhtml\Room as RoomController;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magenes\Cybergame\Model\RoomFactory;
use Magento\Framework\App\Cache\TypeListInterface;
use Magento\Framework\App\Cache\Frontend\Pool as FrontendPool;

class Delete extends RoomController
{

    protected $_resultPageFactory;

    protected $_roomFactory;

    protected $_cacheTypeList;

    protected $_cacheFrontendPool;

    public function __construct(
        Context $context,
        Registry $coreRegistry,
        PageFactory $resultPageFactory,
        RoomFactory $roomFactory,
        TypeListInterface $cacheTypeList,
        FrontendPool $cacheFrontendPool
    )
    {
        $this->_resultPageFactory = $resultPageFactory;
        $this->_roomFactory = $roomFactory;
        $this->_cacheTypeList = $cacheTypeList;
        $this->_cacheFrontendPool = $cacheFrontendPool;
        parent::__construct($context, $coreRegistry);
    }
    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('id');
        if ($id) {
            try {
                $model = $this->_roomFactory->create();
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccessMessage(__('You deleted the room.'));
                $this->_cacheTypeList->cleanType('config');
                foreach ($this->_cacheFrontendPool as $cacheFrontend) {
                    $cacheFrontend->getBackend()->clean();
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }
        $this->messageManager->addErrorMessage(__('We can\'t find a room to delete.'));
        return $resultRedirect->setPath('*/*/');
    }
}