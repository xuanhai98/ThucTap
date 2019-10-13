<?php

namespace Magenests\XuanHai\Controller\Index;

class Ajax extends \Magento\Framework\App\Action\Action
{
    protected $customerRepositoryInterface;
    protected $resultJsonFactory;
    public function __construct
    (
        \Magento\Framework\App\Action\Context $context,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepositoryInterface,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
    )
    {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->customerRepositoryInterface = $customerRepositoryInterface;
        parent::__construct($context);
    }

    public function execute()
    {
        $value = $this->getRequest()->getParams('value');
        $result = $this->resultJsonFactory->create();
        $customerId = $value['value'];
        $customer = $this->customerRepositoryInterface->getById($customerId);
        $result->setData([
            'id'=>$customerId,
            'firstname'=>$customer->getFirstname(),
            'lastname'=>$customer->getLastname(),
            'email'=>$customer->getEmail()
        ]);
        return $result;
    }
}
