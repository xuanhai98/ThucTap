<?php
namespace Magenes\Cybergame\Model\ResourceModel\Room\Grid;
use Magenes\Cybergame\Model\ResourceModel\Room\Collection as RoomCollection;
use Magento\Framework\Api\Search\SearchResultInterface;
use Magento\Framework\Data\Collection\EntityFactoryInterface;
use Psr\Log\LoggerInterface;
use Magento\Framework\Data\Collection\Db\FetchStrategyInterface;
use Magento\Framework\Event\ManagerInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Api\SearchCriteriaInterface;
class Collection extends RoomCollection implements SearchResultInterface
{

    protected $_aggregations;

    public function __construct(
        EntityFactoryInterface $entityFactory,
        LoggerInterface $logger,
        FetchStrategyInterface $fetchStrategy,
        ManagerInterface $eventManager,
        $mainTable = 'room_extra_option',
        $eventPrefix,
        $eventObject,
        $resourceModel,
        $model ='Magento\Framework\View\Element\UiComponent\DataProvider\Document',
        AdapterInterface $connection = null,
        AbstractDb $resource = null
    )
    {
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $connection, $resource);
        $this->_eventPrefix = $eventPrefix;
        $this->_eventObject = $eventObject;
        $this->_init($model, $resourceModel);
        $this->setMainTable($mainTable);
    }

    public function _construct()
    {
        parent::_construct();
        $this->addFilterToMap(
            'id',
            'main_table.id'
        );
        $this->addFilterToMap(
            'product id',
            'main_table.product_id'
        );
        $this->addFilterToMap(
            'number pc',
            'main_table.number_pc'
        );$this->addFilterToMap(
            'address',
            'main_table.address'
        );$this->addFilterToMap(
            'food price',
            'main_table.food_price'
        );$this->addFilterToMap(
            'drink price',
            'main_table.drink_price'
        );$this->addFilterToMap(
            'created at',
            'main_table.created_at'
        );$this->addFilterToMap(
            'updated at',
            'main_table.updated_at'
        );
    }

    protected function _initSelect()
    {
        parent::_initSelect();
        return $this;
    }

    public function getAggregations()
    {
        return $this->_aggregations;
    }


    public function setAggregations($aggregations)
    {
        $this->_aggregations = $aggregations;
    }

    protected function _getAllIdsSelect($limit = null, $offset = null)
    {
        $idsSelect = clone $this->getSelect();
        $idsSelect->reset(\Magento\Framework\DB\Select::ORDER);
        $idsSelect->reset(\Magento\Framework\DB\Select::LIMIT_COUNT);
        $idsSelect->reset(\Magento\Framework\DB\Select::LIMIT_OFFSET);
        $idsSelect->reset(\Magento\Framework\DB\Select::COLUMNS);
        $idsSelect->columns($this->getResource()->getIdFieldName(),'main_table');
        $idsSelect->limit($limit, $offset);
        return $idsSelect;
    }

    public function getAllIds($limit = null, $offset = null)
    {
        return $this->getConnection()->fetchCol($this->_getAllIdsSelect($limit, $offset), $this->_bindParams);
    }

    public function getSearchCriteria()
    {
        return null;
    }

    public function setSearchCriteria(SearchCriteriaInterface $searchCriteria = null)
    {
        return $this;
    }

    public function getTotalCount()
    {
        return $this->getSize();
    }

    public function setTotalCount($totalCount)
    {
        return $this;
    }

    public function setItems(array $items = null)
    {
        return $this;
    }
}
