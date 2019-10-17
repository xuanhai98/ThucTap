<?php
namespace Magenes\Cybergame\Block\Room\Registry;
use OTPHP\HOTP;

class DetailRoom extends \Magento\Framework\View\Element\Template
{
    protected $_roomFactory;

    protected $_request;

    public function __construct(
        \Magento\Framework\App\RequestInterface $request,
        \Magento\Framework\View\Element\Template\Context $context,
        \Magenes\Cybergame\Model\RoomFactory $roomFactory
    ) {
        $this->_roomFactory = $roomFactory;
        $this->_request = $request;
        parent::__construct($context);
    }

    public function getRoomData()
    {
        $idProduct = $this->_request->getParam('id');
        $roomData = $this->_roomFactory->create()->getCollection()->addFieldToFilter('product_id',$idProduct)->getFirstItem();
        return $roomData;
    }
}
