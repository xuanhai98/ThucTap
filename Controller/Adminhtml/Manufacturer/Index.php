<?php
namespace Project1\Test1\Controller\Adminhtml\Manufacturer;
use Project1\Test1\Controller\Adminhtml\Manufacturer as ManufacturerController;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Json\Helper\Data as JsonHelper;
class Index extends ManufacturerController
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
        $resultPage->setActiveMenu('Project1_Test1::manufacturer_listing');
        $resultPage->getConfig()->getTitle()->prepend(__("Manufacturer"));
        return $resultPage;
    }

    public function jsonResponse($response = '')
    {
        return $this->getResponse()->representJson(
            $this->_jsonHelper->jsonEncode($response)
        );
    }
}