<?php
namespace Magenest3\XuanHai\Model;
use Magento\Framework\Model\AbstractModel;
class Hotel extends AbstractModel
{

    protected function _construct()
    {
        $this->_init('Magenest3\XuanHai\Model\ResourceModel\Hotel');
    }
}