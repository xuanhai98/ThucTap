<?php
namespace Magenest3\XuanHai\Controller\Adminhtml\Hotel;

use Magenest3\XuanHai\Controller\Adminhtml\Hotel as HotelController;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magenest3\XuanHai\Model\HotelFactory;
use Magento\Framework\App\Cache\TypeListInterface;
use Magento\Framework\App\Cache\Frontend\Pool as FrontendPool;

class Delete extends HotelController
{

    protected $_resultPageFactory;

    protected $_hotelFactory;

    protected $_cacheTypeList;

    protected $_cacheFrontendPool;

    public function __construct(
        Context $context,
        Registry $coreRegistry,
        PageFactory $resultPageFactory,
        HotelFactory $hotelFactory,
        TypeListInterface $cacheTypeList,
        FrontendPool $cacheFrontendPool
    )
    {
        $this->_resultPageFactory = $resultPageFactory;
        $this->_hotelFactory = $hotelFactory;
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
        $id = $this->getRequest()->getParam('hotel_id');
        if ($id) {
            try {
                $model = $this->_hotelFactory->create();
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccessMessage(__('You deleted the Hotel.'));
                $this->_cacheTypeList->cleanType('config');
                foreach ($this->_cacheFrontendPool as $cacheFrontend) {
                    $cacheFrontend->getBackend()->clean();
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['hotel_id' => $id]);
            }
        }
        $this->messageManager->addErrorMessage(__('We can\'t find a Hotel to delete.'));
        return $resultRedirect->setPath('*/*/');
    }
}