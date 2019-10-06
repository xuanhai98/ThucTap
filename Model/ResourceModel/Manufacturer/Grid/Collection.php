<?php
namespace Project1\Test1\Model\ResourceModel\Manufacturer\Grid;
use Project1\Test1\Model\ResourceModel\Manufacturer\Collection as ManufacturerCollection;
use Magento\Framework\Api\Search\SearchResultInterface;
use Magento\Framework\Data\Collection\EntityFactoryInterface;
use Psr\Log\LoggerInterface;
use Magento\Framework\Data\Collection\Db\FetchStrategyInterface;
use Magento\Framework\Event\ManagerInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Api\SearchCriteriaInterface;
class Collection extends ManufacturerCollection implements SearchResultInterface
{

    protected $_aggregations;

    public function __construct(
        EntityFactoryInterface $entityFactory,
        LoggerInterface $logger,
        FetchStrategyInterface $fetchStrategy,
        ManagerInterface $eventManager,
        $mainTable = 'manufacturer_entity',
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
            'entity_id',
            'main_table.entity_id'
        );
        $this->addFilterToMap(
            'name',
            'main_table.name'
        );
        $this->addFilterToMap(
            'enabled',
            'main_table.enabled'
        );$this->addFilterToMap(
            'address street',
            'main_table.address_street'
        );$this->addFilterToMap(
            'address city',
            'main_table.address_city'
        );$this->addFilterToMap(
            'address country',
            'main_table.address_country'
        );$this->addFilterToMap(
            'contact name',
            'main_table.contact_name'
        );$this->addFilterToMap(
            'contact phone',
            'main_table.contact_phone'
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
        $idsSelect->columns($this->getResource()->getIdFieldName(), 'main_table');
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
