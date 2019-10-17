<?php
namespace Magenes\Cybergame\Model\ResourceModel\Room;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
class Collection extends AbstractCollection
{
    protected $_idFieldName = 'id';

    protected function _construct()
    {
        $this->_init('Magenes\Cybergame\Model\Room','Magenes\Cybergame\Model\ResourceModel\Room');
        $this->_map['fields']['id'] = 'main_table.id';
    }

    public function toOptionArray()
    {
        $options = [];
        return $options;
    }
}