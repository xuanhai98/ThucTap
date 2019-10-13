<?php

namespace Magenests\XuanHai\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Customer\Model\Customer;

class CheckCreateAccountCustomer implements ObserverInterface
{

    protected $_customerRepositoryInterface;
    protected $_customerSession;
    protected $_customerFactory;
    protected $_vendorFactory;
    protected $_request;

    public function __construct(
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepositoryInterface,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Customer\Model\CustomerFactory $customerFactory,
        \Magento\Framework\App\RequestInterface $request,
        \Magenests\XuanHai\Model\VendorFactory $vendorFactory
    ) {
        $this->_request = $request;
        $this->_customerFactory = $customerFactory;
        $this->_customerRepositoryInterface = $customerRepositoryInterface;
        $this->_customerSession = $customerSession;
        $this->_vendorFactory = $vendorFactory;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $customerData = $observer->getCustomer();
        $customerId = $customerData->getId();
        $customer = $this->_customerFactory->create()->load($customerId);
        $isVendor = $this->_request->getParam('xuanhai_is_approved', false);
        if ($isVendor) {
            $customer->setMhIsApproved(0);
            $customerModel = $customer->getResource();
            $customerModel->saveAttribute($customer, 'xuanhai_is_approved');
        }
        $obj=$this->request->getPostValue();
        if ($obj) {
            $data = $this->_vendorFactory->create();
            $data->addData([
                "customer_id" => $customerId,
                "first_name" => $customer->getFirstname(),
                "last_name" => $customer->getLastname(),
                "email" => $customer->getEmail()
            ]);
            $data->save();
        }
    }
}