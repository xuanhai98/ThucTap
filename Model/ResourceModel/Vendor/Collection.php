<?php
namespace Magenests\XuanHai\Model\ResourceModel\Vendor;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
class Collection extends AbstractCollection
{
    protected $_idFieldName = 'id';

    protected function _construct()
    {
        $this->_init('Magenests\XuanHai\Model\Vendor', 'Magenests\XuanHai\Model\ResourceModel\Vendor');
        $this->_map['fields']['id'] = 'main_table.id';
    }

    public function toOptionArray()
    {
        $options = [];
        return $options;
    }
}