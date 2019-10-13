<?php
namespace Magenests\XuanHai\Controller\Adminhtml\Vendor;
use Magenests\XuanHai\Controller\Adminhtml\Vendor as VendorController;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magenests\XuanHai\Model\VendorFactory;
use Magento\Framework\App\Cache\TypeListInterface;
use Magento\Framework\App\Cache\Frontend\Pool as FrontendPool;
class Delete extends VendorController
{

    protected $_resultPageFactory;

    protected $_vendorFactory;

    protected $_cacheTypeList;

    protected $_cacheFrontendPool;

    public function __construct(
        Context $context,
        Registry $coreRegistry,
        PageFactory $resultPageFactory,
        VendorFactory $vendorFactory,
        TypeListInterface $cacheTypeList,
        FrontendPool $cacheFrontendPool
    )
    {
        $this->_resultPageFactory = $resultPageFactory;
        $this->_vendorFactory = $vendorFactory;
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
                $model = $this->_vendorFactory->create();
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccessMessage(__('You deleted the Vendor.'));
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
        $this->messageManager->addErrorMessage(__('We can\'t find a Vendor to delete.'));
        return $resultRedirect->setPath('*/*/');
    }
}