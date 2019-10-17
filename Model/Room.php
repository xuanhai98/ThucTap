<?php
namespace Magenes\Cybergame\Model;
use Magento\Framework\Model\AbstractModel;
class Room extends AbstractModel
{

    protected function _construct()
    {
        $this->_init('Magenes\Cybergame\Model\ResourceModel\Room');
    }
}