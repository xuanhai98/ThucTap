<?php
namespace Project1\Test1\Model\ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
class Manufacturer extends AbstractDb
{

    protected function _construct()
    {
        $this->_init('manufacturer_entity', 'entity_id');
    }
}