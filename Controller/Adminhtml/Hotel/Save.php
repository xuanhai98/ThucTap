<?php
namespace Magenest3\XuanHai\Controller\Adminhtml\Hotel;
use Magenest3\XuanHai\Controller\Adminhtml\Hotel as HotelController;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magenest3\XuanHai\Model\HotelFactory;
use Magento\Framework\App\Cache\TypeListInterface;
use Magento\Framework\App\Cache\Frontend\Pool as FrontendPool;
use Magento\Framework\Stdlib\DateTime\DateTime;
class Save extends HotelController
{

    protected $_hotelFactory;

    protected $_cacheTypeList;

    protected $_cacheFrontendPool;

    protected $_dateTime;

    public function __construct(
        Context $context,
        Registry $coreRegistry,
        HotelFactory $hotelFactory,
        TypeListInterface $cacheTypeList,
        FrontendPool $cacheFrontendPool,
        DateTime $dateTime
    )
    {
        $this->_hotelFactory = $hotelFactory;
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
            $id = $this->getRequest()->getParam('hotel_id');
            $model = $this->_hotelFactory->create();
            if ($id) {
                $model->load($id);
            }
            $hotelData = array(
                'hotel_name' => $data['hotel_name'],
                'location_street' => $data['location_street'],
                'location_city' => $data['location_city'],
                'location_state' => $data['location_state'],
                'location_country' => $data['location_country'],
                'contact_phone' => $data['contact_phone'],
                'total_available_room' => $data['total_available_room'],
                'available_single' => $data['available_single'],
                'available_double' => $data['available_double'],
                'available_triple' => $data['available_triple'],
            );
            $model->addData($hotelData);
            try {
                $model->save();
                $this->messageManager->addSuccessMessage(__('Successfully saved new hotel'));
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['hotel_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving hotel.'));
            }
            return $resultRedirect->setPath('*/*/edit', ['hotel_id' => $this->getRequest()->getParam('hotel_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}