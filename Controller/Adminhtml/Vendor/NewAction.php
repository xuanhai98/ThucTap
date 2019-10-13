<?php
namespace Magenests\XuanHai\Controller\Adminhtml\Vendor;
use Magenests\XuanHai\Controller\Adminhtml\Vendor as VendorController;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Json\Helper\Data as JsonHelper;
class NewAction extends VendorController
{

    protected $_resultPageFactory;

    protected $_jsonHelper;

    public function __construct(
        Context $context,
        Registry $coreRegistry,
        PageFactory $resultPageFactory,
        JsonHelper $jsonHelper
    )
    {
        $this->_resultPageFactory = $resultPageFactory;
        $this->_jsonHelper = $jsonHelper;
        parent::__construct($context, $coreRegistry);
    }

    public function execute()
    {
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('Magenests_XuanHai::vendor_form');
        $resultPage->getConfig()->getTitle()->prepend(__("Vendor"));
        return $resultPage;
    }

    public function jsonResponse($response = '')
    {
        return $this->getResponse()->representJson(
            $this->_jsonHelper->jsonEncode($response)
        );
    }
}