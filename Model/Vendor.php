<?php
namespace Magenests\XuanHai\Model;
use Magento\Framework\Model\AbstractModel;
class Vendor extends AbstractModel
{

    protected function _construct()
    {
        $this->_init('Magenests\XuanHai\Model\ResourceModel\Vendor');
    }
}