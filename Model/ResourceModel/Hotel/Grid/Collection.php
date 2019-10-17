<?php
namespace Magenest3\XuanHai\Model\ResourceModel\Hotel\Grid;
use Magenest3\XuanHai\Model\ResourceModel\Hotel\Collection as HotelCollection;
use Magento\Framework\Api\Search\SearchResultInterface;
use Magento\Framework\Data\Collection\EntityFactoryInterface;
use Psr\Log\LoggerInterface;
use Magento\Framework\Data\Collection\Db\FetchStrategyInterface;
use Magento\Framework\Event\ManagerInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Api\SearchCriteriaInterface;
class Collection extends HotelCollection implements SearchResultInterface
{

    protected $_aggregations;

    public function __construct(
        EntityFactoryInterface $entityFactory,
        LoggerInterface $logger,
        FetchStrategyInterface $fetchStrategy,
        ManagerInterface $eventManager,
        $mainTable = 'magenest_test_hotel_xuanhai',
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
            'hotel id',
            'main_table.hotel_id'
        );
        $this->addFilterToMap(
            'hotel name',
            'main_table.hotel_name'
        );
        $this->addFilterToMap(
            'location street',
            'main_table.location_street'
        );$this->addFilterToMap(
            'location city',
            'main_table.location_city'
        );$this->addFilterToMap(
            'location state',
            'main_table.location_state'
        );$this->addFilterToMap(
            'location country',
            'main_table.location_country'
        );$this->addFilterToMap(
            'contact phone',
            'main_table.contact_phone'
        );$this->addFilterToMap(
            'total available room',
            'main_table.total_available_room'
        );$this->addFilterToMap(
            'available single',
            'main_table.available_single'
        );$this->addFilterToMap(
            'available double',
            'main_table.available_double'
        );$this->addFilterToMap(
            'available triple',
            'main_table.available_triple'
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
