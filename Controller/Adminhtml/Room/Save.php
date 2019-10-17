<?php
namespace Magenes\Cybergame\Controller\Adminhtml\Room;
use Magenes\Cybergame\Controller\Adminhtml\Room as RoomController;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magenes\Cybergame\Model\RoomFactory;
use Magento\Framework\App\Cache\TypeListInterface;
use Magento\Framework\App\Cache\Frontend\Pool as FrontendPool;
use Magento\Framework\Stdlib\DateTime\DateTime;
class Save extends RoomController
{

    protected $_roomFactory;

    protected $_cacheTypeList;

    protected $_cacheFrontendPool;

    protected $_dateTime;

    public function __construct(
        Context $context,
        Registry $coreRegistry,
        RoomFactory $roomFactory,
        TypeListInterface $cacheTypeList,
        FrontendPool $cacheFrontendPool,
        DateTime $dateTime
    )
    {
        $this->_roomFactory = $roomFactory;
        $this->_cacheTypeList = $cacheTypeList;
        $this->_cacheFrontendPool = $cacheFrontendPool;
        $this->_dateTime = $dateTime;
        parent::__construct($context, $coreRegistry);
    }

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            $id = $this->getRequest()->getParam('id');
            $model = $this->_roomFactory->create();
            if ($id) {
                $model->load($id);
            }
            $roomData = array(
                'product_id' => $data['product_id'],
                'number_pc' => $data['number_pc'],
                'address' => $data['address'],
                'food_price' => $data['food_price'],
                'drink_price' => $data['drink_price'],
                'created_at' => $data['created_at'],
                'updated_at' => $data['updated_at'],
            );
            $model->addData($roomData);
            try {
                $model->save();
                $this->messageManager->addSuccessMessage(__('Successfully saved new room'));
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving room.'));
            }
            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}