<?php
namespace Magenests\XuanHai\Model\ResourceModel\Vendor\Grid;
use Magenests\XuanHai\Model\ResourceModel\Vendor\Collection as VendorCollection;
use Magento\Framework\Api\Search\SearchResultInterface;
use Magento\Framework\Data\Collection\EntityFactoryInterface;
use Psr\Log\LoggerInterface;
use Magento\Framework\Data\Collection\Db\FetchStrategyInterface;
use Magento\Framework\Event\ManagerInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Api\SearchCriteriaInterface;
class Collection extends VendorCollection implements SearchResultInterface
{

    protected $_aggregations;

    public function __construct(
        EntityFactoryInterface $entityFactory,
        LoggerInterface $logger,
        FetchStrategyInterface $fetchStrategy,
        ManagerInterface $eventManager,
        $mainTable = 'magenest_test_vendor_xuanhai',
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
            'customer id',
            'main_table.customer_id'
        );
        $this->addFilterToMap(
            'first name',
            'main_table.first_name'
        );$this->addFilterToMap(
            'last name',
            'main_table.last_name'
        );$this->addFilterToMap(
            'email',
            'main_table.email'
        );$this->addFilterToMap(
            'company',
            'main_table.company'
        );$this->addFilterToMap(
            'phone number',
            'main_table.phone_number'
        );$this->addFilterToMap(
            'fax',
            'main_table.fax'
        );$this->addFilterToMap(
            'address',
            'main_table.address'
        );$this->addFilterToMap(
            'street',
            'main_table.street'
        );$this->addFilterToMap(
            'country',
            'main_table.country'
        );$this->addFilterToMap(
            'city',
            'main_table.city'
        );$this->addFilterToMap(
            'postcode',
            'main_table.postcode'
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
