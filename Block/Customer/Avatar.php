<?php
/**
 * Created by PhpStorm.
 * User: mdq
 * Date: 09/05/2019
 * Time: 13:29
 */

namespace Magenest\EavTest\Block\Customer;

use Magento\Framework\View\Element\Template;
use Magento\Framework\UrlInterface;

class Avatar extends Template
{
    protected $_customer;
    protected $_customerSession;

    public function __construct(
        Template\Context $context,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepositoryInterface,
        \Magento\Customer\Model\Session $customerSession,
        array $data = []
    ){
        parent::__construct($context, $data);
        $this->_customer = $customerRepositoryInterface;
        $this->_customerSession = $customerSession;
    }

    public function getCustomerData(){
        $customerId = $this->_customerSession->getCustomer()->getId();
        $customer = $this->_customer->getById($customerId);
        return $customer;
    }
}