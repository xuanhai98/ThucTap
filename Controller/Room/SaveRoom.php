<?php
namespace Magenes\Cybergame\Controller\Room;

class SaveRoom extends \Magento\Framework\App\Action\Action
{
    protected $_roomCollectionFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magenes\Cybergame\Model\ResourceModel\Room\CollectionFactory $roomCollectionFactory
    ) {
        $this->_roomCollectionFactory = $roomCollectionFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        $room = $this->_roomCollectionFactory->create();
        $formEditRoomInfo = $this->_request->getParams();
        foreach ($room as $item) {
            if ($formEditRoomInfo['id'] == $item->getId()) {
                $item->addData([
                    "number_pc" => $formEditRoomInfo['number_pc'],
                    "address" => $formEditRoomInfo['address'],
                    "food_price" => $formEditRoomInfo['food_price'],
                    "drink_price" => $formEditRoomInfo['drink_price']
                ]);
                $saveSucces = $item->save();
                if ($saveSucces) {
                    return $this->_redirect('*/*/index');
                }
            }
        }
    }
}
