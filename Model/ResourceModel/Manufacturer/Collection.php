<?php
namespace Project1\Test1\Model\ResourceModel\Manufacturer;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
class Collection extends AbstractCollection
{
    protected $_idFieldName = 'entity_id';

    protected function _construct()
    {
        $this->_init('Project1\Test1\Model\Manufacturer', 'Project1\Test1\Model\ResourceModel\Manufacturer');
        $this->_map['fields']['entity_id'] = 'main_table.entity_id';
    }

    public function toOptionArray()
    {
        $options = [];
        return $options;
    }
}