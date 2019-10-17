<?php
namespace Magenest3\XuanHai\Model\ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
class Hotel extends AbstractDb
{

    protected function _construct()
    {
        $this->_init('magenest_test_hotel_xuanhai', 'hotel_id');
    }
}