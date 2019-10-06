<?php
namespace Project1\Test1\Controller\Adminhtml\Manufacturer;
use Project1\Test1\Controller\Adminhtml\Manufacturer as ManufacturerController;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Project1\Test1\Model\ManufacturerFactory;
use Magento\Framework\App\Cache\TypeListInterface;
use Magento\Framework\App\Cache\Frontend\Pool as FrontendPool;
class Delete extends ManufacturerController
{

    protected $_resultPageFactory;

    protected $_manufacturerFactoryFactory;

    protected $_cacheTypeList;

    protected $_cacheFrontendPool;

    public function __construct(
        Context $context,
        Registry $coreRegistry,
        PageFactory $resultPageFactory,
        ManufacturerFactory $manufacturerFactory,
        TypeListInterface $cacheTypeList,
        FrontendPool $cacheFrontendPool
    )
    {
        $this->_resultPageFactory = $resultPageFactory;
        $this->_manufacturerFactoryFactory = $manufacturerFactory;
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
        $id = $this->getRequest()->getParam('entity_id');
        if ($id) {
            try {
                $model = $this->_manufacturerFactoryFactory->create();
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccessMessage(__('You deleted the Manufacturer.'));
                $this->_cacheTypeList->cleanType('config');
                foreach ($this->_cacheFrontendPool as $cacheFrontend) {
                    $cacheFrontend->getBackend()->clean();
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['entity_id' => $id]);
            }
        }
        $this->messageManager->addErrorMessage(__('We can\'t find a Manufacturer to delete.'));
        return $resultRedirect->setPath('*/*/');
    }
}