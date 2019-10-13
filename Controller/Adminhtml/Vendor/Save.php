<?php
namespace Magenests\XuanHai\Controller\Adminhtml\Vendor;
use Magenests\XuanHai\Controller\Adminhtml\Vendor as VendorController;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magenests\XuanHai\Model\VendorFactory;
use Magento\Framework\App\Cache\TypeListInterface;
use Magento\Framework\App\Cache\Frontend\Pool as FrontendPool;
use Magento\Framework\Stdlib\DateTime\DateTime;
class Save extends VendorController
{

    protected $_vendorFactory;

    protected $_cacheTypeList;

    protected $_cacheFrontendPool;

    protected $_dateTime;

    public function __construct(
        Context $context,
        Registry $coreRegistry,
        VendorFactory $vendorFactory,
        TypeListInterface $cacheTypeList,
        FrontendPool $cacheFrontendPool,
        DateTime $dateTime
    )
    {
        $this->_vendorFactory = $vendorFactory;
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
            $model = $this->_vendorFactory->create();
            if ($id) {
                $model->load($id);
            }
            $vendorData = array(
                'customer_id' => $data['customer_id'],
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'company' => $data['company'],
                'phone_number' => $data['phone_number'],
                'fax' => $data['fax'],
                'address' => $data['address'],
                'street' => $data['street'],
                'country' => $data['country'],
                'city' => $data['city'],
                'postcode' => $data['postcode']
            );
            $model->addData($vendorData);
            try {
                $model->save();
                $this->messageManager->addSuccessMessage(__('Successfully saved new vendor'));
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving vendor.'));
            }
            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}