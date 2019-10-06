<?php
namespace Project1\Test1\Model;
use Magento\Framework\Model\AbstractModel;
class Manufacturer extends AbstractModel
{

    protected function _construct()
    {
        $this->_init('Project1\Test1\Model\ResourceModel\Manufacturer');
    }
}