<?php
namespace Magenes\Cybergame\Controller\Adminhtml\Room;
use Magenes\Cybergame\Controller\Adminhtml\Room as RoomController;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Json\Helper\Data as JsonHelper;
class Index extends RoomController
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
        $resultPage->setActiveMenu('Magenes_Cybergame::room_listing');
        $resultPage->getConfig()->getTitle()->prepend(__("Room"));
        return $resultPage;
    }

    public function jsonResponse($response = '')
    {
        return $this->getResponse()->representJson(
            $this->_jsonHelper->jsonEncode($response)
        );
    }
}