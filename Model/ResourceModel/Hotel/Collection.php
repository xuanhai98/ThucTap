<?php
namespace Magenest3\XuanHai\Model\ResourceModel\Hotel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
class Collection extends AbstractCollection
{
    protected $_idFieldName = 'hotel_id';

    protected function _construct()
    {
        $this->_init('Magenest3\XuanHai\Model\Hotel', 'Magenest3\XuanHai\Model\ResourceModel\Hotel');
        $this->_map['fields']['hotel_id'] = 'main_table.hotel_id';
    }

    public function toOptionArray()
    {
        $options = [];
        return $options;
    }
}