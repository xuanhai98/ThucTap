<?php
namespace Magenes\Cybergame\Model\ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
class Room extends AbstractDb
{

    protected function _construct()
    {
        $this->_init('room_extra_option', 'id');
    }
}