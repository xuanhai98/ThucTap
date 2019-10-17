<?php
namespace Magenes\Cybergame\Block\Room\Registry;
class ListRoom extends \Magento\Framework\View\Element\Template
{
    protected $_roomCollectionFactory;

    protected $_customerSession;

    protected $_storeManager;

    protected $_customerFactory;

    private $_dataCyberGame = [];

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magenes\Cybergame\Model\ResourceModel\Room\CollectionFactory $roomCollectionFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Customer\Model\CustomerFactory $customerFactory
    ) {
        $this->_roomCollectionFactory = $roomCollectionFactory;
        $this->_storeManager = $storeManager;
        $this->_customerFactory = $customerFactory;
        $this->_customerSession = $customerSession;
        parent::__construct($context);
    }


    public function getRoomData(){
        $room = $this->_roomCollectionFactory->create();
        $i = 0;
        foreach ($room as $data) {
            $this->_dataCyberGame += [
                $i++ => [
                    'id' => $data->getId(),
                    'product_id' => $data->getProductId(),
                    'room_name' => $data->getRoomName(),
                    'price' => $data->getPrice(),
                    ],
            ];
        }
        return $this->_dataCyberGame;
    }

    public function getMyURL(){
        return $this->_storeManager->getStore()->getBaseUrl();
    }
}
