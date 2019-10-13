<?php
namespace Magenests\XuanHai\Model\ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
class Vendor extends AbstractDb
{

    protected function _construct()
    {
        $this->_init('magenest_test_vendor_xuanhai', 'id');
    }
}