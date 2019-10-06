<?php
namespace Project1\Test1\Controller\Adminhtml\Manufacturer;
use Project1\Test1\Controller\Adminhtml\Manufacturer as ManufacturerController;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Project1\Test1\Model\ManufacturerFactory;
use Magento\Framework\App\Cache\TypeListInterface;
use Magento\Framework\App\Cache\Frontend\Pool as FrontendPool;
use Magento\Framework\Stdlib\DateTime\DateTime;
class Save extends ManufacturerController
{

    protected $_manufacturerFactory;

    protected $_cacheTypeList;

    protected $_cacheFrontendPool;

    protected $_dateTime;

    public function __construct(
        Context $context,
        Registry $coreRegistry,
        ManufacturerFactory $manufacturerFactory,
        TypeListInterface $cacheTypeList,
        FrontendPool $cacheFrontendPool,
        DateTime $dateTime
    )
    {
        $this->_manufacturerFactory = $manufacturerFactory;
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
            $id = $this->getRequest()->getParam('entity_id');
            $model = $this->_manufacturerFactory->create();
            if ($id) {
                $model->load($id);
            }
            $manufacturerData = array(
                'name' => $data['name'],
                'enabled' => $data['enabled'],
                'address_street' => $data['address_street'],
                'address_city' => $data['address_city'],
                'address_country' => $data['address_country'],
                'contact_name' => $data['contact_name'],
                'contact_phone' => $data['contact_phone'],
            );
            $model->addData($manufacturerData);
            try {
                $model->save();
                $this->messageManager->addSuccessMessage(__('Successfully saved new manufacturer'));
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['entity_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving manufacturer.'));
            }
            return $resultRedirect->setPath('*/*/edit', ['entity_id' => $this->getRequest()->getParam('entity_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}